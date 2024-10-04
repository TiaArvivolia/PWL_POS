@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah</a>
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
                        <select class="form-control" id="kategori_id" name="kategori_id">
                            <option value="">- Semua -</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Kategori Barang</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori Barang</th> <!-- Ensure this matches the new column added -->
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
$(document).ready(function() {
    var dataBarang = $('#table_barang').DataTable({
        ajax: {
            url: "{{ url('barang/list') }}",
            type: "POST",
            data: function (d) {
                d.kategori_id = $('#kategori_id').val(); // Pass the selected category_id for filtering
            }
        },
        columns: [
            { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
            { data: "barang_kode", orderable: true, searchable: true },
            { data: "barang_nama", orderable: true, searchable: true },
            { data: "kategori.kategori_nama", orderable: true, searchable: true }, // Ensure this matches the name in the addColumn method
            { data: "harga_beli", orderable: true, searchable: false, render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ') },
            { data: "harga_jual", orderable: true, searchable: false, render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ') },
            { data: "aksi", orderable: false, searchable: false }
        ]
    });

    $('#kategori_id').on('change', function() {
        dataBarang.ajax.reload(); // Reload data when category filter changes
    });
});
</script>
@endpush