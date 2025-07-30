@extends('layouts.app')
@section('title', $produk->Nama_produk)

@section('content')
<div class="container mx-auto px-4 py-6 pt-20 max-w-4xl">

    {{-- Nama Produk --}}
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-4">{{ $produk->Nama_produk }}</h1>

    {{-- Tanggal Publikasi --}}
    <p class="text-center text-gray-500 text-sm mb-6">
        Dipublikasikan pada: {{ \Carbon\Carbon::parse($produk
            ->created_at)->translatedFormat('d F Y, H:i A') }}
    </p>

    {{-- Deskripsi Produk --}}
    <article class="text-gray-800 mb-8 leading-relaxed" style="text-align: justify;">
        {!! nl2br(e($produk->Deskripsi)) !!}
    </article>

    {{-- Tombol Kembali --}}
    <div class="mb-10">
        <a href="{{ route('produk.index') }}"
           class="inline-block bg-gray-600 hover:bg-gray-700 text-white text-sm px-5 py-2 rounded transition duration-300">
            ← Kembali ke Produk
        </a>
    </div>
</div>
@endsection