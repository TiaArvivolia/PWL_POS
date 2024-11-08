<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use Monolog\Barang;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request)
    {
        // Set validation
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'required|string|unique:m_barang,barang_kode|max:10', // Unique constraint for barang_kode
            'barang_nama' => 'required|string|max:100', // Validate barang_nama
            'harga_beli'  => 'required|integer', // Validate harga_beli
            'harga_jual'  => 'required|integer', // Validate harga_jual
            'kategori_id' => 'required|integer|exists:m_kategori,kategori_id', // Validate kategori_id
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create user
        $image =  $request->file('image');

        $barang = BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'nama' => $request->nama,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
            'image' => $image->hashName(),
        ]);

        return response()->json($barang, 201);
    }

    public function show(BarangModel $barang)
    {
        return BarangModel::find($barang);
    }

    // public function update(Request $request, BarangModel $barang)
    // {
    //     $barang->update($request->all());
    //     return BarangModel::find($barang);
    // }

    public function update(Request $request, BarangModel $barang)
    {
        // Set validation
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode,' . $barang->id, // Unique constraint for barang_kode, ignoring current record
            'barang_nama' => 'required|string|max:100', // Validate barang_nama
            'harga_beli'  => 'required|integer', // Validate harga_beli
            'harga_jual'  => 'required|integer', // Validate harga_jual
            'kategori_id' => 'required|integer|exists:m_kategori,kategori_id', // Validate kategori_id
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Image validation, nullable for updating without image
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Check if image is uploaded, handle it accordingly
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $barang->image = $image->hashName(); // Update the image field
        }

        // Update the barang record with validated data
        $barang->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
            'image' => isset($image) ? $image->hashName() : $barang->image, // Keep the old image if no new image is uploaded
        ]);

        // Return the updated barang
        return response()->json($barang, 200);
    }


    public function destroy(BarangModel $barang)
    {
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',

        ]);
    }
}
