@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Supplier</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/supplier/import') }}')" class="btn btn-info btn-sm mt-1">
                <i class="fas fa-file-import"></i> Import Supplier
            </button>
            <a href="{{ url('/supplier/export_excel') }}" class="btn btn-primary btn-sm mt-1">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ url('/supplier/export_pdf') }}" class="btn btn-warning btn-sm mt-1">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <button onclick="modalAction('{{ url('supplier/create_ajax') }}')" class="btn btn-success btn-sm mt-1">
                <i class="fas fa-plus"></i> Tambah Data (Ajax)
            </button>
        </div>        
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Supplier</th>
                    <th>Nama Supplier</th>
                    <th>Alamat Supplier</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
<script>
function modalAction(url = ''){
    $('#myModal').load(url, function(){
        $('#myModal').modal('show');
    });
}

var dataSupplier;
$(document).ready(function(){
    dataSupplier = $('#table_supplier').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "{{ url('supplier/list') }}",
            "dataType": "json",
            "type": "POST",
            "data": function (d) {
                // You can add additional filters here if needed
            }
        },
        columns: [
            {
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            },
            {
                data: "supplier_kode",
                orderable: true,
                searchable: true
            },
            {
                data: "supplier_nama",
                orderable: true,
                searchable: true
            },
            {
                data: "supplier_alamat",
                orderable: true,
                searchable: true
            },
            {
                data: "aksi",
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
@endpush
