<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Produk - Bird
        </h2>
    </x-slot>

    {{-- Card History Semua Perubahan --}}
    @php
    $query = App\Models\ProdukHistory::with(['produk', 'user']);

    // Filter berdasarkan action
    if (request('action') && request('action') !== 'all') {
    $query->where('action', request('action'));
    }

    // Search functionality
    if (request('search')) {
    $searchTerm = request('search');
    $query->where(function($q) use ($searchTerm) {
    $q->where('changes_description', 'LIKE', "%{$searchTerm}%")
    ->orWhereHas('produk', function($subQuery) use ($searchTerm) {
    $subQuery->where('Nama_produk', 'LIKE', "%{$searchTerm}%");
    })
    ->orWhereHas('user', function($subQuery) use ($searchTerm) {
    $subQuery->where('name', 'LIKE', "%{$searchTerm}%");
    });
    });
    }

    $allHistories = $query->orderBy('created_at', 'desc')->paginate(20);
    @endphp
    @if($allHistories->count() > 0)
    <div class="container mt-4 shadow rounded p-4 bg-white mx-5" style="max-width: calc(100% - 100px);">
        <a href="{{ route('produk.index') }}"
            class="inline-block bg-red-600 hover:bg-red-700 text-white text-sm px-5 py-2 rounded transition duration-300">
            ← Kembali ke Produk
        </a>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="text-primary mb-0">
                <i class="bi bi-clock-history me-2"></i>Semua Aktivitas History
            </h6>
            <div class="d-flex align-items-center">
                <span class="badge bg-secondary me-2">Total: {{ $allHistories->total() }} record</span>

                {{-- Alternative: Select dropdown instead of Bootstrap dropdown --}}
                <form method="GET" class="d-inline">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <select name="action" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                        <option value="all" {{ request('action', 'all') == 'all' ? 'selected' : '' }}>Semua Aktivitas</option>
                        <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Dibuat</option>
                        <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Diperbarui</option>
                    </select>
                </form>
            </div>
        </div>

        {{-- Search Box --}}
        <div class="mb-3">
            <form method="GET" class="d-flex gap-2">
                <input type="hidden" name="action" value="{{ request('action', 'all') }}">
                <input type="text" name="search" class="form-control" placeholder="Cari nama produk, deskripsi, atau nama user..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Cari
                </button>
                @if(request('search') || (request('action') && request('action') !== 'all'))
                <a href="{{ request()->url() }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
                @endif
            </form>
        </div>

        @foreach($allHistories as $history)
        <div class="card mb-2 border-start border-4 @if($history->action == 'created') border-success @elseif($history->action == 'updated') border-warning @else border-danger @endif">
            <div class="card-body py-2 px-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-1">
                            <h6 class="card-title mb-0 fs-6 me-2">
                                @if($history->action == 'created')
                                <i class="bi bi-plus-circle text-success me-1"></i>
                                @elseif($history->action == 'updated')
                                <i class="bi bi-pencil-square text-warning me-1"></i>
                                @else
                                <i class="bi bi-trash text-danger me-1"></i>
                                @endif
                                {{ $history->produk->Nama_produk ?? 'Produk Terhapus' }}
                            </h6>
                            <span class="badge 
                                    @if($history->action == 'created') bg-success 
                                    @elseif($history->action == 'updated') bg-warning 
                                    @else bg-danger 
                                    @endif">
                                {{ ucfirst($history->action) }}
                            </span>
                        </div>
                        <p class="card-text mb-1 text-muted small">{{ $history->changes_description }}</p>
                        @if($history->user)
                        <p class="card-text mb-0 text-muted" style="font-size: 0.75rem;">
                            <i class="bi bi-person me-1"></i>oleh: {{ $history->user->name }}
                        </p>
                        @endif
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block">{{ $history->created_at->diffForHumans() }}</small>
                        <small class="text-muted" style="font-size: 0.7rem;">{{ $history->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Pagination Links --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $allHistories->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    <div class="container mt-4 shadow rounded p-4 bg-white mx-5" style="max-width: calc(100% - 100px);">
        <div class="text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
            <h5 class="text-muted mt-3">Belum ada history aktivitas</h5>
            <p class="text-muted">History perubahan produk akan muncul di sini</p>
        </div>
        <div>
            <a href="record" class="inline-block bg-red-600 hover:bg-red-700 text-white text-sm px-5 py-2 rounded transition duration-300">Kembali</a>
        </div>
    </div>
    @endif

    {{-- Pastikan Bootstrap JS sudah dimuat --}}
    @push('scripts')
    <script>
        // Pastikan dropdown Bootstrap berfungsi
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi manual jika diperlukan
            var dropdowns = document.querySelectorAll('[data-bs-toggle="dropdown"]');
            dropdowns.forEach(function(dropdown) {
                new bootstrap.Dropdown(dropdown);
            });
        });

        // Function untuk filter berdasarkan action
        function filterByAction(action) {
            const url = new URL(window.location);
            if (action === 'all') {
                url.searchParams.delete('action');
            } else {
                url.searchParams.set('action', action);
            }
            url.searchParams.delete('page'); // Reset pagination
            window.location.href = url.toString();
        }

        // Function untuk clear search
        function clearSearch() {
            const url = new URL(window.location);
            url.searchParams.delete('search');
            url.searchParams.delete('action');
            url.searchParams.delete('page');
            window.location.href = url.toString();
        }
    </script>
    @endpush

    {{-- Jika Bootstrap belum dimuat, tambahkan CDN --}}
    @if(!isset($bootstrapLoaded))
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
    @endif
</x-app-layout>