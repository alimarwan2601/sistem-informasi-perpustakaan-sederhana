
@extends('layouts.app')

@section('title', 'Tambah Pengguna')
@section('header', 'Tambah Pengguna')

@section('content')

<div class="content-card">

    <h2>Form Tambah Pengguna</h2>
    <p>Masukkan informasi akun pengguna baru.</p>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:15px;">
            <label>Nama Lengkap</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">

            @error('name')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">

            @error('email')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Password</label>
            <input type="password"
                   name="password"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">

            @error('password')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Konfirmasi Password</label>
            <input type="password"
                   name="password_confirmation"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">
        </div>

        <div style="margin-bottom:20px;">
            <label>Role Pengguna</label>
            <select name="role"
                    style="display:block; width:100%; padding:10px; margin-top:5px;">
                <option value="">-- Pilih Role --</option>

                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>

                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>
                    Petugas
                </option>
            </select>

            @error('role')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit"
                style="background:#2563eb; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
            Simpan Pengguna
        </button>

        <a href="{{ route('users.index') }}" style="margin-left:10px;">
            Kembali
        </a>

    </form>

</div>

@endsection
