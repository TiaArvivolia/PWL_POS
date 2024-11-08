<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Monolog\Kategori;
use Illuminate\Support\Facades\Validator;


class KategoriController extends Controller
{
    public function index()
    {
        return KategoriModel::all();
    }

    // public function store(Request $request)
    // {
    //     $kategori = KategoriModel::create($request->all());
    //     return response()->json($kategori, 201);
    // }

    public function store(Request $request)
    {
        // Set validation
        $validator = Validator::make($request->all(), [
            'kategori_kode' => 'required|string|unique:m_kategori,kategori_kode|max:10', // Unique constraint for kategori_kode
            'kategori_nama' => 'required|string|max:100', // Validate kategori_nama
        ]);
        
        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $barang = KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return response()->json($barang, 201);
    }

    public function show(KategoriModel $kategori)
    {
        return KategoriModel::find($kategori);
    }

    public function update(Request $request, KategoriModel $kategori)
    {
        $kategori->update($request->all());
        return KategoriModel::find($kategori);
    }

    public function destroy(KategoriModel $barang)
    {
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',

        ]);
    }
}