<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Models\Produk;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $produk = Produk::all();
    return view('dashboard', compact('produk'));
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
