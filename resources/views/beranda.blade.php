@extends('layouts.app')

@section('content')
<!-- Hero Section with Background Image -->
<div class="hero-section">
    <style>
        .hero-section {
            background-image: url('{{ asset('images/apotek1.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
    </style>
    <div class="container h-100 d-flex justify-content-center align-items-center text-white">
        <div class="text-center">
            <h1 class="display-4">Selamat Datang di Apotek24</h1>
            <p class="lead">Temukan obat dan produk kesehatan dengan mudah dan cepat.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Lihat Produk</a>
        </div>
    </div>
</div>

<!-- Additional Images Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <img src="{{ asset('images/apotek2.jpg') }}" class="img-fluid" alt="Produk 1">
        </div>
        <div class="col-md-4 mb-4">
            <img src="{{ asset('images/apotek3.webp') }}" class="img-fluid" alt="Produk 2">
        </div>
        <div class="col-md-4 mb-4">
            <img src="{{ asset('images/apotek4.webp') }}" class="img-fluid" alt="Produk 3">
        </div>
    </div>
</div>
@endsection
