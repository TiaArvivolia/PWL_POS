@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Stok</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-success btn-sm mt-1">Tambah Stok (Ajax)</button>
        </div>
    </div>

    <div class="card-body">
        <!-- untuk Filter data -->
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-sm row text-sm mb-0">
                        <label for="filter_supplier" class="col-md-1 col-form-label">Filter</label>
                        <div class="col-md-3">
                            <select name="filter_supplier" class="form-control form-control-sm filter_supplier">
                                <option value="">- Semua Supplier -</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Supplier</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-sm table-striped table-hover" id="table-stok">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Barang</th>
                    <th>Supplier</th>
                    <th>User</th>
                    <th>Tanggal Stok</th>
                    <th>Jumlah Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>
@endsection

@push('js')
<script>
function modalAction(url = ''){
    $('#myModal').load(url, function(){
        $('#myModal').modal('show');
    });
}

var tableStok;
$(document).ready(function(){
    tableStok = $('#table-stok').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "{{ url('stok/list') }}",
            "dataType": "json",
            "type": "POST",
            "data": function (d) {
                d.filter_supplier = $('.filter_supplier').val();
            }
        },
        columns: [
    {
        data: "DT_RowIndex", // Index
        className: "text-center",
        orderable: false,
        searchable: false
    },
    {
        data: "barang.barang_nama", // Nama barang
        orderable: true,
        searchable: true
    },
    {
        data: "supplier.supplier_nama", // Nama supplier
        orderable: true,
        searchable: true
    },
    {
        data: "user.nama", // Nama pengguna
        orderable: true,
        searchable: true
    },
    {
        data: "stok_tanggal",
        orderable: true,
        searchable: false,
        render: function(data) {
            return new Date(data).toLocaleString('id-ID'); // Format tanggal
        }
    },
    {
        data: "stok_jumlah",
        orderable: true,
        searchable: false,
        className: "text-center"
    },
    {
        data: "aksi",
        className: "text-center",
        orderable: false,
        searchable: false
    }
]

    });

    $('.filter_supplier').change(function() {
        tableStok.draw();
    });
});
</script>
@endpush
