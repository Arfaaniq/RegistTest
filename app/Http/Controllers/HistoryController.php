<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukHistory;

class HistoryController extends Controller
{
    // Di Controller Anda (misalnya ProdukController.php)

    public function historyIndex(Request $request)
    {
        $query = ProdukHistory::with(['produk', 'user']);

        // Filter berdasarkan action
        if ($request->has('action') && $request->action !== 'all') {
            $query->where('action', $request->action);
        }

        // Search berdasarkan nama produk
        if ($request->has('search') && !empty($request->search)) {
            $query->whereHas('produk', function ($q) use ($request) {
                $q->where('Nama_produk', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan tanggal (opsional)
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $allHistories = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('produk.history', compact('allHistories'));
    }

    // Atau jika Anda ingin tetap menggunakan view yang sama:
    public function index(Request $request)
    {
        // Logika lain untuk halaman produk...

        // Untuk history
        $query = ProdukHistory::with(['produk', 'user']);

        // Jika parameter 'show_all' ada, tampilkan semua
        if ($request->has('show_all')) {
            // Filter berdasarkan action
            if ($request->has('action') && $request->action !== 'all') {
                $query->where('action', $request->action);
            }

            // Search berdasarkan nama produk
            if ($request->has('search') && !empty($request->search)) {
                $query->whereHas('produk', function ($q) use ($request) {
                    $q->where('Nama_produk', 'LIKE', '%' . $request->search . '%');
                });
            }

            $allHistories = $query->orderBy('created_at', 'desc')->paginate(20);
        } else {
            // Tampilkan hanya yang terbaru (seperti sebelumnya)
            $allHistories = $query->latest()->take(5)->get();
        }

        return view('produk.index', compact('allHistories'));
    }
}
