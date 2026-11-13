
@extends('layouts.app')

@section('title', 'Edit Pengguna')
@section('header', 'Edit Pengguna')

@section('content')

<div class="content-card">

    <h2>Form Edit Pengguna</h2>
    <p>Perbarui informasi akun pengguna.</p>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom:15px;">
            <label>Nama Lengkap</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $user->name) }}"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">

            @error('name')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email', $user->email) }}"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">

            @error('email')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Password Baru</label>
            <input type="password"
                   name="password"
                   placeholder="Kosongkan jika tidak ingin mengubah password"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">

            @error('password')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Konfirmasi Password Baru</label>
            <input type="password"
                   name="password_confirmation"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">
        </div>

        <div style="margin-bottom:20px;">
            <label>Role Pengguna</label>
            <select name="role"
                    style="display:block; width:100%; padding:10px; margin-top:5px;">

                <option value="admin"
                    {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>

                <option value="petugas"
                    {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>
                    Petugas
                </option>

            </select>

            @error('role')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit"
                style="background:#2563eb; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
            Perbarui Pengguna
        </button>

        <a href="{{ route('users.index') }}" style="margin-left:10px;">
            Kembali
        </a>

    </form>

</div>

@endsection
