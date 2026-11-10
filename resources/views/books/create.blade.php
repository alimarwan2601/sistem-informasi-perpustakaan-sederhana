@extends('layouts.app')

@section('title', 'Tambah Buku')
@section('header', 'Tambah Buku')

@section('content')

<div class="content-card">

    <h2>Form Tambah Buku</h2>
    <p>Masukkan informasi buku yang ingin ditambahkan.</p>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Kategori Buku</label>
            <select name="category_id" style="display: block; width: 100%; padding: 10px; margin-top: 5px;">
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>Judul Buku</label>
            <input type="text" name="title"
                   value="{{ old('title') }}"
                   style="display: block; width: 100%; padding: 10px; margin-top: 5px;">

            @error('title')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>Penulis</label>
            <input type="text" name="author"
                   value="{{ old('author') }}"
                   style="display: block; width: 100%; padding: 10px; margin-top: 5px;">

            @error('author')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>Penerbit</label>
            <input type="text" name="publisher"
                   value="{{ old('publisher') }}"
                   style="display: block; width: 100%; padding: 10px; margin-top: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Tahun Terbit</label>
            <input type="number" name="publication_year"
                   value="{{ old('publication_year') }}"
                   min="1900" max="{{ date('Y') }}"
                   style="display: block; width: 100%; padding: 10px; margin-top: 5px;">

            @error('publication_year')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>ISBN</label>
            <input type="text" name="isbn"
                   value="{{ old('isbn') }}"
                   style="display: block; width: 100%; padding: 10px; margin-top: 5px;">

            @error('isbn')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label>Stok Buku</label>
            <input type="number" name="stock"
                   value="{{ old('stock', 0) }}"
                   min="0"
                   style="display: block; width: 100%; padding: 10px; margin-top: 5px;">

            @error('stock')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit"
                style="background: #2563eb; color: white; padding: 10px 18px; border: none; border-radius: 6px; cursor: pointer;">
            Simpan Buku
        </button>

        <a href="{{ route('books.index') }}"
           style="margin-left: 10px;">
            Kembali
        </a>

    </form>

</div>

@endsection