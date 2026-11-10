@extends('layouts.app')

@section('title', 'Detail Buku')
@section('header', 'Detail Buku')

@section('content')

<div class="content-card">

    <h2>Detail Informasi Buku</h2>

    <table style="width: 100%; border-collapse: collapse;">

        <tr>
            <th style="text-align: left; padding: 12px; width: 200px;">Judul Buku</th>
            <td style="padding: 12px;">{{ $book->title }}</td>
        </tr>

        <tr>
            <th style="text-align: left; padding: 12px;">Kategori</th>
            <td style="padding: 12px;">{{ $book->category->name ?? '-' }}</td>
        </tr>

        <tr>
            <th style="text-align: left; padding: 12px;">Penulis</th>
            <td style="padding: 12px;">{{ $book->author }}</td>
        </tr>

        <tr>
            <th style="text-align: left; padding: 12px;">Penerbit</th>
            <td style="padding: 12px;">{{ $book->publisher ?? '-' }}</td>
        </tr>

        <tr>
            <th style="text-align: left; padding: 12px;">Tahun Terbit</th>
            <td style="padding: 12px;">{{ $book->publication_year ?? '-' }}</td>
        </tr>

        <tr>
            <th style="text-align: left; padding: 12px;">ISBN</th>
            <td style="padding: 12px;">{{ $book->isbn ?? '-' }}</td>
        </tr>

        <tr>
            <th style="text-align: left; padding: 12px;">Stok Buku</th>
            <td style="padding: 12px;">{{ $book->stock }}</td>
        </tr>

    </table>

    <div style="margin-top: 20px;">
        <a href="{{ route('books.edit', $book) }}"
           style="background: #2563eb; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none;">
            Edit Buku
        </a>

        <a href="{{ route('books.index') }}"
           style="margin-left: 10px;">
            Kembali ke Daftar Buku
        </a>
    </div>

</div>

@endsection