<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Fungsi untuk menampilkan daftar produk
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Fungsi untuk menampilkan halaman tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Fungsi untuk menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        // Menyimpan data produk
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Fungsi untuk menampilkan halaman edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Fungsi untuk update produk
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        // Update produk
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    // Fungsi untuk menghapus produk
    public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
}

    // Fungsi untuk membuat transaksi dan mengurangi stok produk
    public function createTransaction(Request $request)
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
            return redirect()->route('products.index')->with('error', 'Stok produk tidak mencukupi!');
        }

        // Buat transaksi baru
        $transaction = Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $product->price * $request->quantity,
        ]);

        // Kurangi stok produk berdasarkan kuantitas yang dibeli
        $product->decrement('stock', $request->quantity);

        return redirect()->route('products.index')->with('success', 'Transaksi berhasil dibuat dan stok produk terupdate!');
    }
}
