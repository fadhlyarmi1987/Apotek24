@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1 class="display-4">Selamat Datang di Apotek24</h1>
    <p class="lead">Temukan obat dan produk kesehatan dengan mudah dan cepat.</p>
    <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">Tambah Produk</a>
</div>

<div class="row mt-5">
    <div class="col-md-4">
        <div class="card">
            <img src="https://via.placeholder.com/300" class="card-img-top" alt="Produk Obat">
            <div class="card-body">
                <h5 class="card-title">Obat Paracetamol</h5>
                <p class="card-text">Obat penurun panas dan pereda nyeri. Harga: Rp 10.000,-</p>
                <a href="#" class="btn btn-primary">Lihat Detail</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <img src="https://via.placeholder.com/300" class="card-img-top" alt="Produk Obat">
            <div class="card-body">
                <h5 class="card-title">Obat Batuk</h5>
                <p class="card-text">Obat batuk untuk meredakan batuk berdahak. Harga: Rp 15.000,-</p>
                <a href="#" class="btn btn-primary">Lihat Detail</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <img src="https://via.placeholder.com/300" class="card-img-top" alt="Produk Obat">
            <div class="card-body">
                <h5 class="card-title">Vitamin C</h5>
                <p class="card-text">Vitamin untuk meningkatkan daya tahan tubuh. Harga: Rp 20.000,-</p>
                <a href="#" class="btn btn-primary">Lihat Detail</a>
            </div>
        </div>
    </div>
</div>
@endsection
