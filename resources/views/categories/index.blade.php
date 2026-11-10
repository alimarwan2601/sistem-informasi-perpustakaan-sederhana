@extends('layouts.app')

@section('title', 'Data Kategori')
@section('header', 'Data Kategori')

@section('content')

<div class="content-card">

    <h2>Daftar Kategori</h2>

    <a href="{{ route('categories.create') }}">+ Tambah Kategori</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $categories->firstItem() + $loop->index }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? '-' }}</td>
                    <td>{{ $category->books_count }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}">Edit</a>

                        <form action="{{ route('categories.destroy', $category) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->links() }}

</div>

@endsection
