<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Produk
        </h2>
    </x-slot>

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

    {{-- Alert untuk pesan sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-5 mt-3" role="alert" style="border-left: 4px solid #28a745;">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 text-success"></i>
            <div>
                <strong>Berhasil!</strong> {{ session('success') }}
                <br><small class="text-muted">{{ now()->format('d M Y, H:i') }}</small>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif



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

    <div class="container mt-4 shadow rounded p-4 bg-white" style="max-width: calc(100% - 100px);">
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
                        <th style="color: #ff0000" class="px-3 py-2">Penambah</th>
                        <th style="color: #ff0000" class="px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($produk as $index => $produk)
                    <tr style="border-top: 1px solid #dee2e6;">
                        <td class="px-3 py-2">{{ $index + 1 }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $produk->Nama_produk }}</td>
                        <td class="px-3 py-2" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $produk->Deskripsi }}</td>
                        <td class="px-3 py-2">Rp. {{ number_format($produk->Harga, 0, ',', '.') }},-</td>
                        <td class="px-3 py-2">{{ $produk->Stok }}</td>
                        <td>{{ $produk->user->name ?? 'Tidak diketahui' }}</td>
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

                    {{-- Modal Edit (sama seperti sebelumnya) --}}
                    <div class="modal fade" id="editModal{{ $produk->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $produk->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content rounded-4 shadow">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h5 class="modal-title" id="editModalLabel{{ $produk->id }}">Edit Produk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4 pt-0">
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
                                            <input id="Deskripsi{{ $produk->id }}" type="text" name="Deskripsi" class="form-control" value="{{ $produk->Deskripsi }}" />
                                            <div class="invalid-feedback">Mohon masukkan Deskripsi Produk.</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="Harga{{ $produk->id }}" class="form-label fw-semibold">Harga</label>
                                            <input type="number" id="Harga{{ $produk->id }}" name="Harga" class="form-control" value="{{ $produk->Harga }}" required min="0">
                                            <div class="invalid-feedback">Mohon masukkan Harga Produk.</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="Stok{{ $produk->id }}" class="form-label fw-semibold">Stok</label>
                                            <input type="number" id="Stok{{ $produk->id }}" name="Stok" class="form-control" value="{{ $produk->Stok }}" required min="0">
                                            <div class="invalid-feedback">Mohon masukkan Stok Produk.</div>
                                        </div>

                                        <div class="d-flex justify-content-end gap-2 mt-4">
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
                        <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Card History Perubahan Terbaru --}}
    @php
    $recentHistories = App\Models\ProdukHistory::with(['produk', 'user'])
    ->latest()
    ->take(3)
    ->get();
    @endphp

    @if($recentHistories->count() > 0)
    <div class="container mt-4 shadow rounded p-4 bg-white mx-5" style="max-width: calc(100% - 100px);">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="text-primary mb-0">
                <i class="bi bi-clock-history me-2"></i>Aktivitas Terbaru
            </h6>
            <h6 class="text-primary mb-0">
                <i class="bi bi-three-dots-vertical"></i><a href="record" class="inline-block px-1 rounded hover:bg-red-500 hover:text-white transition">
                    View more
                </a>
            </h6>
        </div>
        @foreach($recentHistories as $history)
        <div class="card mb-2 border-start border-4 @if($history->action == 'created') border-success @elseif($history->action == 'updated') border-warning @else border-danger @endif">
            <div class="card-body py-2 px-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="card-title mb-1 fs-6">
                            @if($history->action == 'created')
                            <i class="bi bi-plus-circle text-success me-1"></i>
                            @elseif($history->action == 'updated')
                            <i class="bi bi-pencil-square text-warning me-1"></i>
                            @else
                            <i class="bi bi-trash text-danger me-1"></i>
                            @endif
                            {{ $history->produk->Nama_produk ?? 'Produk Terhapus' }}
                        </h6>
                        <p class="card-text mb-1 text-muted small">{{ $history->changes_description }}</p>
                    </div>
                    <small class="text-muted">{{ $history->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    {{-- Modal Tambah Produk (sama seperti sebelumnya) --}}
    <div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0">
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
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')

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

    // Auto hide alert after 5 seconds
    setTimeout(function() {
        let alert = document.querySelector('.alert');
        if (alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);
</script>