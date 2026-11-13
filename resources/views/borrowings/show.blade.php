@extends('layouts.app')

@section('title', 'Detail Peminjaman')
@section('header', 'Detail Peminjaman')

@section('content')

<div class="content-card">

    <h2>Detail Transaksi Peminjaman</h2>

    @if (session('success'))
        <div style="background:#dcfce7; color:#166534; padding:12px; border-radius:6px; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:12px; border-radius:6px; margin-bottom:15px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <table style="width:100%; border-collapse:collapse; margin-bottom:25px;">

        <tr>
            <th style="text-align:left; padding:12px; width:200px;">ID Transaksi</th>
            <td style="padding:12px;">{{ $borrowing->id }}</td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Nama Anggota</th>
            <td style="padding:12px;">{{ $borrowing->member->name }}</td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Petugas</th>
            <td style="padding:12px;">{{ $borrowing->user->name }}</td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Tanggal Peminjaman</th>
            <td style="padding:12px;">{{ $borrowing->borrowed_at->format('d-m-Y') }}</td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Jatuh Tempo</th>
            <td style="padding:12px;">{{ $borrowing->due_date->format('d-m-Y') }}</td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Tanggal Pengembalian</th>
            <td style="padding:12px;">
                {{ $borrowing->returned_at ? $borrowing->returned_at->format('d-m-Y') : 'Belum dikembalikan' }}
            </td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Status</th>
            <td style="padding:12px;">
                {{ ucfirst($borrowing->status) }}
            </td>
        </tr>

    </table>

    <h3>Daftar Buku yang Dipinjam</h3>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f1f5f9; text-align:left;">
                    <th style="padding:12px;">No</th>
                    <th style="padding:12px;">Judul Buku</th>
                    <th style="padding:12px;">Penulis</th>
                    <th style="padding:12px;">Jumlah</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($borrowing->borrowingDetails as $detail)
                    <tr style="border-bottom:1px solid #e2e8f0;">
                        <td style="padding:12px;">{{ $loop->iteration }}</td>
                        <td style="padding:12px;">{{ $detail->book->title }}</td>
                        <td style="padding:12px;">{{ $detail->book->author }}</td>
                        <td style="padding:12px;">{{ $detail->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($borrowing->status === 'borrowed')
        <form action="{{ route('borrowings.return', $borrowing) }}"
              method="POST"
              style="margin-top:25px;"
              onsubmit="return confirm('Yakin ingin memproses pengembalian semua buku pada transaksi ini?')">

            @csrf

            <button type="submit"
                    style="background:#16a34a; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Proses Pengembalian
            </button>

        </form>
    @else
        <p style="margin-top:25px; color:#15803d;">
            Semua buku dalam transaksi ini sudah dikembalikan.
        </p>
    @endif

    <div style="margin-top:20px;">
        <a href="{{ route('borrowings.index') }}">Kembali ke Daftar Peminjaman</a>
    </div>

</div>

@endsection