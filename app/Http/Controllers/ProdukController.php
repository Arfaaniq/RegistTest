<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukHistory;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function dashboard()
    {
        $produk = Produk::all();
        return view('dashboard', compact('produk'));
    }

    public function index(Request $request)
    {
        $query = Produk::with('user');

        // Cek apakah ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('Nama_produk', 'like', '%' . $request->search . '%');
        }

        $produk = $query->orderBy('id', 'asc')->paginate(10);

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
            'Deskripsi' => 'nullable|string|max:1000', // Sudah dinaikkan ke 1000
            'Harga' => 'required|integer',
            'Stok' => 'required|integer',
        ]);

        $validated['user_id'] = auth()->id();

        $produk = Produk::create($validated);

        // Catat history pembuatan produk
        ProdukHistory::create([
            'produk_id' => $produk->id,
            'user_id' => auth()->id(),
            'action' => 'created',
            'new_values' => $validated,
            'changes_description' => 'Produk baru dibuat oleh ' . auth()->user()->name
        ]);

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
            'Deskripsi' => 'nullable|string|max:1000',
            'Harga' => 'required|integer',
            'Stok' => 'required|integer',
        ]);

        // Simpan nilai lama sebelum update
        $oldValues = $produk->only(['Nama_produk', 'Deskripsi', 'Harga', 'Stok']);

        // Update produk
        $produk->update($validated);

        // Buat deskripsi perubahan
        $changes = [];
        foreach ($validated as $field => $newValue) {
            if ($oldValues[$field] != $newValue) {
                $fieldNames = [
                    'Nama_produk' => 'Nama Produk',
                    'Deskripsi' => 'Deskripsi',
                    'Harga' => 'Harga',
                    'Stok' => 'Stok'
                ];
                $changes[] = $fieldNames[$field] . ' dari "' . $oldValues[$field] . '" menjadi "' . $newValue . '"';
            }
        }

        // Catat history jika ada perubahan
        if (!empty($changes)) {
            ProdukHistory::create([
                'produk_id' => $produk->id,
                'user_id' => auth()->id(),
                'action' => 'updated',
                'old_values' => $oldValues,
                'new_values' => $validated,
                'changes_description' => 'Diperbarui oleh ' . auth()->user()->name . ': ' . implode(', ', $changes)
            ]);
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui oleh ' . auth()->user()->name);
    }

    public function destroy(Produk $produk)
    {
        // Catat history sebelum menghapus
        ProdukHistory::create([
            'produk_id' => $produk->id,
            'user_id' => auth()->id(),
            'action' => 'deleted',
            'old_values' => $produk->only(['Nama_produk', 'Deskripsi', 'Harga', 'Stok']),
            'changes_description' => 'Produk dihapus oleh ' . auth()->user()->name
        ]);

        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus oleh ' . auth()->user()->name);
    }

    public function detail(Produk $produk)
    {
        // Ambil history produk dengan relasi user
        $histories = ProdukHistory::where('produk_id', $produk->id)
            ->with('user')
            ->latest()
            ->get();

        return view('produk.detail', compact('produk', 'histories'));
    }
}
