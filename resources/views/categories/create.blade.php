@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('header', 'Tambah Kategori')

@section('content')

<div class="content-card">

    <h2>Form Tambah Kategori</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label>Nama Kategori</label>
        <input type="text" name="name" value="{{ old('name') }}">

        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <br><br>

        <label>Deskripsi</label>
        <textarea name="description">{{ old('description') }}</textarea>

        @error('description')
            <p>{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('categories.index') }}">Kembali</a>
    </form>

</div>

@endsection