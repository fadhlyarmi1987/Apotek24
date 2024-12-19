@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Riwayat Transaksi</h2>
        <a href="{{ route('products.index') }}" class="btn btn-primary mb-3">Kembali ke Produk</a>
        
        <div class="card">
            <div class="card-body">
                @if($transactions->isEmpty())
                    <p>Belum ada transaksi.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Produk</th>
                                <th>Kuantitas</th>
                                <th>Total Harga</th>
                                <th>Tanggal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->product->name }}</td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    <td>{{ $transaction->created_at->format('d-m-Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
