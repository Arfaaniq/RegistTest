@extends('layouts.app')

@section('title', 'Regist Online') {{-- Judul halaman di tab browser --}}

@section('content')
<div class="container mt-4">
    <div class="text-center">
        <h1>Selamat Datang di Regist Online</h1>
        <p class="lead">Sistem pendaftaran online yang memudahkan Anda untuk mendaftar layanan dengan cepat dan praktis.</p>
        <a href="{{ route('orderservice.create') }}" class="btn btn-primary mt-3">Daftar Sekarang</a>
    </div>
</div>
@endsection
