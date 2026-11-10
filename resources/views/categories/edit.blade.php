@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('header', 'Edit Kategori')

@section('content')

<div class="content-card">

    <h2>Form Edit Kategori</h2>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Kategori</label>
        <input type="text" name="name"
               value="{{ old('name', $category->name) }}">

        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <br><br>

        <label>Deskripsi</label>
        <textarea name="description">{{ old('description', $category->description) }}</textarea>

        @error('description')
            <p>{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Perbarui</button>
        <a href="{{ route('categories.index') }}">Kembali</a>
    </form>

</div>

@endsection