<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel; // Make sure to import the KategoriModel
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    // Display the initial Barang page
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $kategori = KategoriModel::all();     // ambil data level untuk filter level

        $activeMenu = 'barang'; // Set active menu

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

        // Ambil data barang dalam bentuk JSON untuk DataTables
        public function list(Request $request)
        {
            $barangs = barangModel::select('barang_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual','kategori_id')
                ->with('kategori');
    
            // Filter data barang berdasarkan kategori_id
            if ($request->kategori_id) {
                $barangs->where('kategori_id', $request->kategori_id);
            }
    
            return DataTables::of($barangs)
                // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
                ->addIndexColumn()
                ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                    $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                    $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                    $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">'
                        . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
    
                    return $btn;
                })
                ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah HTML
                ->make(true);
        }


    // Show form for adding new Barang
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang baru'
        ];

        $kategori = KategoriModel::all(); // Get all categories for dropdown
        $activeMenu = 'barang'; // Set active menu

        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Store new Barang data
    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|unique:m_barang,barang_kode|max:10', // Unique constraint for barang_kode
            'barang_nama' => 'required|string|max:100', // Validate barang_nama
            'harga_beli'  => 'required|integer', // Validate harga_beli
            'harga_jual'  => 'required|integer', // Validate harga_jual
            'kategori_id' => 'required|integer|exists:m_kategori,kategori_id', // Validate kategori_id
        ]);

        BarangModel::create($request->all()); // Store new Barang

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    // Show details of a Barang
    public function show(string $id)
    {
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang'; // Set active menu

        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    // Show form to edit Barang
    public function edit(string $id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all(); // Get all categories for dropdown

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit barang'
        ];

        $activeMenu = 'barang'; // Set active menu

        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Update Barang data
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode,' . $id . ',barang_id', // Unique constraint for barang_kode, excluding current item
            'barang_nama' => 'required|string|max:100', // Validate barang_nama
            'harga_beli'  => 'required|integer', // Validate harga_beli
            'harga_jual'  => 'required|integer', // Validate harga_jual
            'kategori_id' => 'required|integer|exists:m_kategori,kategori_id', // Validate kategori_id
        ]);

        $barang = BarangModel::find($id);
        $barang->update($request->all()); // Update Barang

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    // Delete Barang
    public function destroy(string $id)
    {
        $check = BarangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            BarangModel::destroy($id); // Delete Barang

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}