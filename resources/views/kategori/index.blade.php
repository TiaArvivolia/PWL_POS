@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('kategori/import') }}')" class="btn btn-sm btn-info mt-1">
                <i class="fas fa-file-import"></i> Import Kategori
            </button>
            <a href="{{ url('kategori/export_excel') }}" class="btn btn-sm btn-primary mt-1">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ url('kategori/export_pdf') }}" class="btn btn-sm btn-warning mt-1">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('kategori/create') }}">
                <i class="fas fa-plus"></i> Tambah
            </a> --}}
            <button onclick="modalAction('{{ url('kategori/create_ajax') }}')" class="btn btn-sm btn-success mt-1">
                <i class="fas fa-plus-circle"></i> Tambah Ajax
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
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="kategori_id" name="kategori_id" required>
                            <option value="">- Semua -</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Kategori Pengguna</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
<script>
function modalAction(url = ''){
    $('#myModal').load(url,function(){
        $('#myModal').modal('show');
    });
};
var dataKategori;
$(document).ready(function() {
    dataKategori = $('#table_kategori').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "{{ url('kategori/list') }}",
            "dataType": "json",
            "type": "POST",
            "data": function (d) {
                d.kategori_id = $('#kategori_id').val();
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
                data: "kategori_kode",
                orderable: true,
                searchable: true
            },
            {
                data: "kategori_nama",
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

    $('#kategori_id').on('change', function() {
        dataKategori.ajax.reload();
    });
});
</script>
@endpush
