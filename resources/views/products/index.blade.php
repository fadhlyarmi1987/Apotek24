@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Daftar Produk</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
        <a href="{{ route('transactions.index') }}" class="btn btn-info mb-3">Riwayat Transaksi</a> <!-- Tombol Riwayat Transaksi -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ Str::limit($product->description, 50) }}</td>
                                <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <!-- Tombol untuk membuka modal -->
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" 
                                            data-id="{{ $product->id }}" data-name="{{ $product->name }}">
                                        Hapus
                                    </button>
                                    <a href="{{ route('transactions.create', $product->id) }}" class="btn btn-success btn-sm">Transaksi</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus produk <strong id="product-name"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Script untuk menangkap data produk yang akan dihapus
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var id = button.data('id'); // ID produk
        var name = button.data('name'); // Nama produk

        var modal = $(this);
        modal.find('#product-name').text(name); // Menampilkan nama produk di modal
        modal.find('#deleteForm').attr('action', '/products/' + id); // Mengatur action form
    });
</script>
@endsection
