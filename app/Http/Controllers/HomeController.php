<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('beranda'); // Ganti 'beranda' dengan nama file blade untuk halaman beranda Anda
    }
}
