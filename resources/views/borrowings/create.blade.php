@extends('layouts.app')

@section('title', 'Tambah Peminjaman')
@section('header', 'Tambah Peminjaman')

@section('content')

<div class="content-card">

    <h2>Form Peminjaman Buku</h2>
    <p>Tanggal peminjaman otomatis hari ini dan jatuh tempo tujuh hari berikutnya.</p>

    @if ($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:12px; border-radius:6px; margin-bottom:15px;">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:20px;">
            <label>Anggota Peminjam</label>

            <select name="member_id"
                    required
                    style="display:block; width:100%; padding:10px; margin-top:5px;">
                <option value="">-- Pilih Anggota --</option>

                @foreach ($members as $member)
                    <option value="{{ $member->id }}"
                        {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->member_code }} - {{ $member->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <h3>Daftar Buku</h3>

        <p>Masukkan jumlah buku yang akan dipinjam. Isi 0 jika tidak dipilih.</p>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#f1f5f9; text-align:left;">
                        <th style="padding:12px;">Judul Buku</th>
                        <th style="padding:12px;">Kategori</th>
                        <th style="padding:12px;">Stok Tersedia</th>
                        <th style="padding:12px;">Jumlah Pinjam</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($books as $book)
                        <tr style="border-bottom:1px solid #e2e8f0;">
                            <td style="padding:12px;">{{ $book->title }}</td>
                            <td style="padding:12px;">{{ $book->category->name ?? '-' }}</td>
                            <td style="padding:12px;">{{ $book->stock }}</td>
                            <td style="padding:12px;">
                                <input
                                    type="number"
                                    name="books[{{ $book->id }}]"
                                    min="0"
                                    max="{{ $book->stock }}"
                                    value="{{ old('books.' . $book->id, 0) }}"
                                    style="width:90px; padding:8px;"
                                >
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding:20px; text-align:center;">
                                Tidak ada buku dengan stok tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            <button type="submit"
                    style="background:#2563eb; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan Peminjaman
            </button>

            <a href="{{ route('borrowings.index') }}" style="margin-left:10px;">
                Kembali
            </a>
        </div>

    </form>

</div>

@endsection