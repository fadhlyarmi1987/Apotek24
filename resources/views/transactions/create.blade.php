@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Buat Transaksi untuk {{ $product->name }}</h2>
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <label for="quantity">Jumlah</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="total_price">Total Harga</label>
                <input type="text" class="form-control" id="total_price" name="total_price" value="Rp. {{ number_format($product->price, 0, ',', '.') }}" readonly>
            </div>
            <button type="submit" class="btn btn-success">Buat Transaksi</button>
            
        </form>
        
    </div>
</div>

<script>
    // Ambil elemen input dan harga
    const quantityInput = document.getElementById('quantity');
    const totalPriceInput = document.getElementById('total_price');
    const productPrice = {{ $product->price }}; // Harga produk

    // Fungsi untuk menghitung total harga
    function calculateTotalPrice() {
        const quantity = parseInt(quantityInput.value) || 0; // Default 0 jika kosong
        const totalPrice = productPrice * quantity;

        // Format total harga ke Rupiah
        totalPriceInput.value = 'Rp. ' + totalPrice.toLocaleString('id-ID');
    }

    // Event listener untuk input jumlah
    quantityInput.addEventListener('input', calculateTotalPrice);
</script>
@endsection
