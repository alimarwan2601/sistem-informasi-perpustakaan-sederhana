show

@extends('layouts.app')

@section('title', 'Detail Anggota')
@section('header', 'Detail Anggota')

@section('content')

<div class="content-card">

    <h2>Detail Informasi Anggota</h2>

    <table style="width:100%; border-collapse:collapse;">

        <tr>
            <th style="text-align:left; padding:12px; width:200px;">Kode Anggota</th>
            <td style="padding:12px;">{{ $member->member_code }}</td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Nama Lengkap</th>
            <td style="padding:12px;">{{ $member->name }}</td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Jenis Kelamin</th>
            <td style="padding:12px;">{{ $member->gender ?? '-' }}</td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Alamat</th>
            <td style="padding:12px;">{{ $member->address ?? '-' }}</td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Nomor Telepon</th>
            <td style="padding:12px;">{{ $member->phone ?? '-' }}</td>
        </tr>

        <tr>
            <th style="text-align:left; padding:12px;">Email</th>
            <td style="padding:12px;">{{ $member->email ?? '-' }}</td>
        </tr>

    </table>

    <div style="margin-top:20px;">

        <a href="{{ route('members.edit', $member) }}"
           style="background:#2563eb; color:white; padding:10px 15px; border-radius:6px; text-decoration:none;">
            Edit Anggota
        </a>

        <a href="{{ route('members.index') }}" style="margin-left:10px;">
            Kembali ke Daftar Anggota
        </a>

    </div>

</div>

@endsection