<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Monolog\Level;
use Illuminate\Support\Facades\Validator;


class LevelController extends Controller
{
    public function index()
    {
        return LevelModel::all();
    }

    // public function store(Request $request)
    // {
    //     $level = LevelModel::create($request->all());
    //     return response()->json($level, 201);
    // }

    public function store(Request $request)
    {
        // Set validation
        $validator = Validator::make($request->all(), [
            'level_kode' => 'required|string|unique:m_level,level_kode|max:10', // Unique constraint for level_kode
            'level_nama' => 'required|string|max:100', // Validate level_nama
        ]);
        
        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $barang = LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return response()->json($barang, 201);
    }

    public function show(LevelModel $level)
    {
        return LevelModel::find($level);
    }

    public function update(Request $request, LevelModel $level)
    {
        $level->update($request->all());
        return LevelModel::find($level);
    }

    public function destroy(LevelModel $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}