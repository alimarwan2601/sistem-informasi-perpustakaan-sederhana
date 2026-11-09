
@extends('layouts.app')

@section('title', 'Dashboard - Perpustakaan')

@section('header', 'Dashboard')

@section('content')

    <div class="page-heading">
        <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>

        <p>
            Berikut adalah ringkasan informasi
            Sistem Informasi Perpustakaan.
        </p>
    </div>

    @if (session('success'))
        <div style="
            background: #dcfce7;
            color: #166534;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        ">
            {{ session('success') }}
        </div>
    @endif

    <div class="stats-grid">

        <div class="stat-card">
            <p>Jumlah Judul Buku</p>
            <h2>{{ number_format($totalBooks) }}</h2>
        </div>

        <div class="stat-card">
            <p>Total Stok Buku</p>
            <h2>{{ number_format($totalStock) }}</h2>
        </div>

        <div class="stat-card">
            <p>Jumlah Anggota</p>
            <h2>{{ number_format($totalMembers) }}</h2>
        </div>

        <div class="stat-card">
            <p>Peminjaman Aktif</p>
            <h2>{{ number_format($activeBorrowings) }}</h2>
        </div>

    </div>

    <div class="content-card">

        <h3>Informasi Pengguna</h3>

        <p>
            Anda login sebagai
            <strong>{{ ucfirst(auth()->user()->role) }}</strong>.
        </p>

        <p>
            Silakan gunakan menu navigasi di sebelah kiri
            untuk mengakses fitur perpustakaan.
        </p>

    </div>

@endsection
