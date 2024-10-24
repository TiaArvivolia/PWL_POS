<?php

namespace App\Http\Controllers;

use App\Models\StokModel; // Import StokModel
use App\Models\BarangModel; // Import BarangModel
use App\Models\SupplierModel; // Import SupplierModel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    // Display the initial Stok page
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok'; // Set active menu

        // Ambil semua supplier dari database
        $suppliers = SupplierModel::all(); // Pastikan model Supplier sudah ada

        return view('stok.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'suppliers' => $suppliers // Kirimkan variabel suppliers ke view
        ]);
    }

    // Ambil data stok dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $stok = StokModel::with(['supplier', 'barang', 'user']) // Load relations
            ->select('stok_id', 'supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah');

        return DataTables::of($stok)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) {
                $btn = '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi']) // Ensure action column supports HTML
            ->make(true);
    }


    // Show form for adding new Stok
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok baru'
        ];

        $barang = BarangModel::all(); // Get all barang for dropdown
        $supplier = SupplierModel::all(); // Get all suppliers for dropdown
        $activeMenu = 'stok'; // Set active menu

        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    // Store new Stok data
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|integer|exists:m_supplier,supplier_id', // Validate supplier_id
            'barang_id' => 'required|integer|exists:m_barang,barang_id', // Validate barang_id
            'user_id' => 'required|integer|exists:m_user,user_id', // Validate user_id
            'stok_tanggal' => 'required|date', // Validate stok_tanggal
            'stok_jumlah' => 'required|integer', // Validate stok_jumlah
        ]);

        StokModel::create($request->all()); // Store new Stok

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    // Show details of a Stok
    public function show(string $id)
    {
        $stok = StokModel::with('supplier', 'barang', 'user')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail stok'
        ];

        $activeMenu = 'stok'; // Set active menu

        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'activeMenu' => $activeMenu]);
    }

    // Show form to edit Stok
    public function edit(string $id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::all(); // Get all barang for dropdown
        $supplier = SupplierModel::all(); // Get all suppliers for dropdown

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit stok'
        ];

        $activeMenu = 'stok'; // Set active menu

        return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'barang' => $barang, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    // Update Stok data
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_id' => 'required|integer|exists:m_supplier,supplier_id', // Validate supplier_id
            'barang_id' => 'required|integer|exists:m_barang,barang_id', // Validate barang_id
            'user_id' => 'required|integer|exists:m_user,user_id', // Validate user_id
            'stok_tanggal' => 'required|date', // Validate stok_tanggal
            'stok_jumlah' => 'required|integer', // Validate stok_jumlah
        ]);

        $stok = StokModel::find($id);
        $stok->update($request->all()); // Update Stok

        return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }

    // Delete Stok
    public function destroy(string $id)
    {
        $check = StokModel::find($id);
        if (!$check) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            StokModel::destroy($id); // Delete Stok

            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();

        return view('stok.create_ajax')
            ->with('barang', $barang)
            ->with('supplier', $supplier);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_id' => 'required|integer|exists:m_supplier,supplier_id',
                'barang_id' => 'required|integer|exists:m_barang,barang_id',
                'user_id' => 'required|integer|exists:m_user,user_id',
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            StokModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data stok berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function show_ajax(string $id)
    {
        $stok = StokModel::with('supplier', 'barang', 'user')->find($id);
        return view('stok.show_ajax', ['stok' => $stok]);
    }

    public function edit_ajax(string $id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::all(); // Get all barang for dropdown
        $supplier = SupplierModel::all(); // Get all suppliers for dropdown

        return view('stok.edit_ajax', ['stok' => $stok, 'barang' => $barang, 'supplier' => $supplier]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_id' => 'required|integer|exists:m_supplier,supplier_id',
                'barang_id' => 'required|integer|exists:m_barang,barang_id',
                'user_id' => 'required|integer|exists:m_user,user_id',
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $stok = StokModel::find($id);
            $stok->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data stok berhasil diubah'
            ]);
        }
        return redirect('/');
    }

    public function delete_ajax(string $id)
    {
        $check = StokModel::find($id);
        if (!$check) {
            return response()->json([
                'status' => false,
                'message' => 'Data stok tidak ditemukan'
            ]);
        }

        try {
            StokModel::destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Data stok berhasil dihapus'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini'
            ]);
        }
    }
}
