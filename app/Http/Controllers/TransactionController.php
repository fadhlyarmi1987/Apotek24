<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        // Ambil semua transaksi
        $transactions = Transaction::with('product')->get(); // Memuat relasi dengan model Product
        return view('transactions.index', compact('transactions'));
    }
    // Fungsi untuk menampilkan halaman transaksi
    public function create($id)
    {
        $product = Product::findOrFail($id);
        return view('transactions.create', compact('product'));
    }

    // Fungsi untuk menyimpan transaksi
    public function store(Request $request)
    {
        // Validasi input transaksi
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        // Ambil produk yang dibeli
        $product = Product::findOrFail($request->product_id);

        // Periksa apakah stok cukup
        if ($product->stock < $request->quantity) {
            session()->flash('error', 'Stok produk tidak mencukupi!');
            return redirect()->route('transactions.create', $product->id);
        }

        // Buat transaksi baru
        $transaction = Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $product->price * $request->quantity,
        ]);

        // Kurangi stok produk berdasarkan kuantitas yang dibeli
        $product->decrement('stock', $request->quantity);

        session()->flash('success', 'Transaksi berhasil dibuat dan stok produk terupdate!');
        return redirect()->route('products.index');
    }
}
