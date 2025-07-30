<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::query();

        // Cek apakah ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('Nama_produk', 'like', '%' . $request->search . '%');
        }

        $produk = $query->latest()->paginate(10);

        // $user = auth()->user(); // ambil user saat ini, bisa dipakai di view jika perlu

        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_produk' => 'required|string|max:255',
            'Deskripsi' => 'required|string|max:255',
            'Harga' => 'required|integer|nullable',
            'Stok' => 'required|integer|nullable',
        ]);

        Produk::create($validated);


        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'Nama_produk' => 'required|string|max:255',
            'Deskripsi' => 'required|string|max:255',
            'Harga' => 'required|integer|nullable',
            'Stok' => 'required|integer|nullable',
        ]);

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
    public function detail(Produk $produk)
    {
        return view('produk.detail', compact('produk'));
    }
}
