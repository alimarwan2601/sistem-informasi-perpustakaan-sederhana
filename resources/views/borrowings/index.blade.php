@extends('layouts.app')

@section('title', 'Transaksi Peminjaman')
@section('header', 'Transaksi Peminjaman')

@section('content')

<div class="content-card">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div>
            <h2>Daftar Peminjaman</h2>
            <p>Kelola transaksi peminjaman buku perpustakaan.</p>
        </div>

        <a href="{{ route('borrowings.create') }}"
           style="background:#2563eb; color:white; padding:10px 15px; border-radius:6px; text-decoration:none;">
            + Tambah Peminjaman
        </a>
    </div>

    @if (session('success'))
        <p style="background:#dcfce7; color:#166534; padding:12px; border-radius:6px;">
            {{ session('success') }}
        </p>
    @endif

    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#f1f5f9; text-align:left;">
                <th style="padding:12px;">No</th>
                <th style="padding:12px;">Anggota</th>
                <th style="padding:12px;">Petugas</th>
                <th style="padding:12px;">Tanggal Pinjam</th>
                <th style="padding:12px;">Jatuh Tempo</th>
                <th style="padding:12px;">Status</th>
                <th style="padding:12px;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($borrowings as $borrowing)
                <tr style="border-bottom:1px solid #e2e8f0;">
                    <td style="padding:12px;">
                        {{ $borrowings->firstItem() + $loop->index }}
                    </td>

                    <td style="padding:12px;">
                        {{ $borrowing->member->name }}
                    </td>

                    <td style="padding:12px;">
                        {{ $borrowing->user->name }}
                    </td>

                    <td style="padding:12px;">
                        {{ $borrowing->borrowed_at->format('d-m-Y') }}
                    </td>

                    <td style="padding:12px;">
                        {{ $borrowing->due_date->format('d-m-Y') }}
                    </td>

                    <td style="padding:12px;">
                        {{ ucfirst($borrowing->status) }}
                    </td>

                    <td style="padding:12px;">
                        <a href="{{ route('borrowings.show', $borrowing) }}">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="padding:20px; text-align:center;">
                        Belum ada transaksi peminjaman.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px;">
        {{ $borrowings->links() }}
    </div>

</div>

@endsection