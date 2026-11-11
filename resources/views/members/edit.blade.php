edit 

@extends('layouts.app')

@section('title', 'Edit Anggota')
@section('header', 'Edit Anggota')

@section('content')

<div class="content-card">

    <h2>Form Edit Anggota</h2>
    <p>Perbarui informasi anggota perpustakaan.</p>

    <form action="{{ route('members.update', $member) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom:15px;">
            <label>Kode Anggota</label>
            <input type="text" name="member_code"
                   value="{{ old('member_code', $member->member_code) }}"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">

            @error('member_code')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Nama Lengkap</label>
            <input type="text" name="name"
                   value="{{ old('name', $member->name) }}"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">

            @error('name')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Jenis Kelamin</label>
            <select name="gender"
                    style="display:block; width:100%; padding:10px; margin-top:5px;">
                <option value="">-- Pilih Jenis Kelamin --</option>

                <option value="Laki-laki"
                    {{ old('gender', $member->gender) == 'Laki-laki' ? 'selected' : '' }}>
                    Laki-laki
                </option>

                <option value="Perempuan"
                    {{ old('gender', $member->gender) == 'Perempuan' ? 'selected' : '' }}>
                    Perempuan
                </option>
            </select>

            @error('gender')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Alamat</label>
            <textarea name="address"
                      style="display:block; width:100%; padding:10px; margin-top:5px;">{{ old('address', $member->address) }}</textarea>
        </div>

        <div style="margin-bottom:15px;">
            <label>Nomor Telepon</label>
            <input type="text" name="phone"
                   value="{{ old('phone', $member->phone) }}"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">

            @error('phone')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:20px;">
            <label>Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $member->email) }}"
                   style="display:block; width:100%; padding:10px; margin-top:5px;">

            @error('email')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit"
                style="background:#2563eb; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
            Perbarui Anggota
        </button>

        <a href="{{ route('members.index') }}" style="margin-left:10px;">
            Kembali
        </a>

    </form>

</div>

@endsection