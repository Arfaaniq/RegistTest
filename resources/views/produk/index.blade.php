@extends('layouts.app')@section('title', 'Produk- ID PROJECT')

@section('content')

<nav aria-label="breadcrumb" class="font-semibold text-m text-black leading-tight mt-6 ms-5">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active" aria-current="page" style="color: #dee2e6;">Produk</li>
    </ol>
</nav>

<strong>
    <h1 class="font-semibold text-xl text-gray-800 dark:text-black leading-tight ms-5">
        Selamat datang, {{ Auth::user()->name }} 👋🏻
    </h1>
</strong>

<div class="d-flex justify-content-between align-items-center mb-4 mt-4 flex-wrap gap-2 ms-5">
    <button type="button"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition font-semibold text-sm"
        data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
        Tambah Produk
    </button>

    <form method="GET" action="{{ route('produk.index') }}" class="d-flex align-items-center gap-2 me-5">
        <input type="text" name="search" placeholder="Pencarian berdasarkan nama..."
            value="{{ request('search') }}"
            class="form-control" style="max-width: 200px;" />
        <button type="submit" class="btn btn-outline-secondary">
            <i class="bi bi-search"></i>
        </button>
    </form>
</div>

<div class="container mt-4 shadow rounded p-4 bg-white">
    <h5 class="mb-3">Daftar Produk</h5>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr style="border-top: 2px solid #dee2e6;">
                    <th style="color: #ff0000" class="px-3 py-2">Id</th>
                    <th style="color: #ff0000" class="px-3 py-2">Nama produk</th>
                    <th style="color: #ff0000" class="px-3 py-2">Deskripsi</th>
                    <th style="color: #ff0000" class="px-3 py-2">Harga</th>
                    <th style="color: #ff0000" class="px-3 py-2">Stok</th>
                    <th style="color: #ff0000" class="px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($produk as $index => $produk)
                <tr style="border-top: 1px solid #dee2e6;">
                    <td class="px-3 py-2">{{ $index + 1 }}</td>
                    <td class="px-3 py-2 whitespace-nowrap">{{ $produk->Nama_produk }}</td>
                    <td class="px-3 py-2">{{ $produk->Deskripsi }}</td>
                    <td class="px-3 py-2">{{ $produk->Harga }}</td>
                    <td class="px-3 py-2">{{ $produk->Stok }}</td>
                    <td class="px-3 py-2">
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $produk->id }}">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            <form action="{{ route('produk.destroy', $produk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                            <form action="{{ route('produk.detail', $produk) }}" method="GET" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="editModal{{ $produk->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $produk->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content rounded-4 shadow">
                            <div class="modal-header border-bottom-0 pb-0"> {{-- Menghilangkan border bawah dan padding bawah --}}
                                <h5 class="modal-title" id="editModalLabel{{ $produk->id }}">Edit Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 pt-0"> {{-- Menyesuaikan padding atas --}}
                                <form method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="Nama_produk{{ $produk->id }}" class="form-label fw-semibold">Nama Produk</label>
                                        <input id="Nama_produk{{ $produk->id }}" type="text" name="Nama_produk" class="form-control" value="{{ $produk->Nama_produk }}" required />
                                        <div class="invalid-feedback">Mohon masukkan Nama Produk.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="Deskripsi{{ $produk->id }}" class="form-label fw-semibold">Deskripsi</label>
                                        <input id="Deskripsi{{ $produk->id }}" type="text" name="Deskripsi" class="form-control" value="{{ $produk->Deskripsi }}" required />
                                        <div class="invalid-feedback">Mohon masukkan Deskripsi Produk.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="Harga{{ $produk->id }}" class="form-label fw-semibold">Harga</label>
                                        <input
                                            type="number"
                                            id="Harga{{ $produk->id }}"
                                            name="Harga"
                                            class="form-control"
                                            value="{{ $produk->Harga }}"
                                            required
                                            min="0">
                                        <div class="invalid-feedback">Mohon masukkan Harga Produk.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Stok{{ $produk->id }}" class="form-label fw-semibold">Stok</label>
                                        <input
                                            type="number"
                                            id="Stok{{ $produk->id }}"
                                            name="Stok"
                                            class="form-control"
                                            value="{{ $produk->Stok }}"
                                            required
                                            min="0">
                                        <div class="invalid-feedback">Mohon masukkan Stok Produk.</div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2 mt-4"> {{-- Menambahkan gap dan margin-top --}}
                                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>


    </div>
</div>

<div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0 pb-0"> {{-- Menghilangkan border bawah dan padding bawah --}}
                <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 pt-0"> {{-- Menyesuaikan padding atas --}}
                <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="Nama_produk" class="form-label fw-semibold">Nama Produk</label>
                        <input id="Nama_produk" type="text" name="Nama_produk" class="form-control" value="{{ old('Nama_produk') }}" required />
                        <div class="invalid-feedback">Mohon masukkan nama produk.</div>
                    </div>
                    <div class="mb-3">
                        <label for="Deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <input id="Deskripsi" type="text" name="Deskripsi" class="form-control" value="{{ old('Deskripsi') }}" required />
                        <div class="invalid-feedback">Mohon masukkan Deskripsi Produk.</div>
                    </div>
                    <div class="mb-3">
                        <label for="Harga" class="form-label fw-semibold">Harga</label>
                        <input type="number" id="Harga" name="Harga" class="form-control" value="{{ old('Harga') }}" required min="0">
                        <div class="invalid-feedback">Mohon masukkan Harga Produk.</div>
                    </div>
                    <div class="mb-3">
                        <label for="Stok" class="form-label fw-semibold">Stok</label>
                        <input type="number" id="Stok" name="Stok" class="form-control" value="{{ old('Stok') }}" required min="0">
                        <div class="invalid-feedback">Mohon masukkan Stok Produk.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    (() => {
        'use strict'
        // Ambil semua form yang ingin kita terapkan gaya validasi Bootstrap kustom
        const forms = document.querySelectorAll('.needs-validation')

        // Loop di atas dan mencegah pengiriman
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection