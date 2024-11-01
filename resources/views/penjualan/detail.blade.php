@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Transaksi Penjualan</h3>
    </div>
    <div class="card-body">
        <h5>Informasi Penjualan</h5>
        <p>ID Penjualan: {{ $penjualan->penjualan_id }}</p>
        <p>Pembeli: {{ $penjualan->pembeli }}</p>
        <p>Tanggal: {{ $penjualan->penjualan_tanggal }}</p>

        <h5>Detail Barang</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Barang ID</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detail as $item)
                <tr>
                    <td>{{ $item->barang_id }}</td>
                    <td>{{ $item->harga }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->harga * $item->jumlah }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h5>Tambah Detail Transaksi</h5>
        <form id="addDetailForm">
            @csrf
            <input type="hidden" name="penjualan_id" value="{{ $penjualan->penjualan_id }}">
            <div class="form-group">
                <label for="barang_id">Pilih Barang</label>
                <select name="barang_id" class="form-control" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Detail</button>
        </form>
    </div>
</div>

<script>
    // Handle form submission
    document.getElementById('addDetailForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('{{ url("/penjualan/" . $penjualan->penjualan_id . "/detail/store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                alert(data.message);
                location.reload(); // Reload page to see updated details
            } else {
                alert(data.message);
            }
        });
    });
</script>
@endsection
