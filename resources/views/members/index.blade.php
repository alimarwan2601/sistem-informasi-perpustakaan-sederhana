@extends('layouts.app')

@section('title', 'Data Anggota')
@section('header', 'Data Anggota')

@section('content')

<div class="content-card">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div>
            <h2>Daftar Anggota</h2>
            <p>Kelola data anggota perpustakaan.</p>
        </div>

        <a href="{{ route('members.create') }}"
           style="background:#2563eb; color:white; padding:10px 15px; border-radius:6px; text-decoration:none;">
            + Tambah Anggota
        </a>
    </div>

    @if (session('success'))
        <p style="background:#dcfce7; color:#166534; padding:12px; border-radius:6px;">
            {{ session('success') }}
        </p>
    @endif

    @if (session('error'))
        <p style="background:#fee2e2; color:#991b1b; padding:12px; border-radius:6px;">
            {{ session('error') }}
        </p>
    @endif

    <form action="{{ route('members.index') }}" method="GET" style="margin-bottom:20px;">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari nama, kode anggota, atau email..."
               style="padding:10px; width:280px; border:1px solid #cbd5e1; border-radius:6px;">

        <button type="submit"
                style="padding:10px 15px; background:#334155; color:white; border:none; border-radius:6px;">
            Cari
        </button>

        <a href="{{ route('members.index') }}">Reset</a>
    </form>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f1f5f9; text-align:left;">
                    <th style="padding:12px;">No</th>
                    <th style="padding:12px;">Kode Anggota</th>
                    <th style="padding:12px;">Nama</th>
                    <th style="padding:12px;">Jenis Kelamin</th>
                    <th style="padding:12px;">Telepon</th>
                    <th style="padding:12px;">Email</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($members as $member)
                    <tr style="border-bottom:1px solid #e2e8f0;">
                        <td style="padding:12px;">
                            {{ $members->firstItem() + $loop->index }}
                        </td>

                        <td style="padding:12px;">{{ $member->member_code }}</td>
                        <td style="padding:12px;">{{ $member->name }}</td>
                        <td style="padding:12px;">{{ $member->gender ?? '-' }}</td>
                        <td style="padding:12px;">{{ $member->phone ?? '-' }}</td>
                        <td style="padding:12px;">{{ $member->email ?? '-' }}</td>

                        <td style="padding:12px; white-space:nowrap;">
                            <a href="{{ route('members.show', $member) }}">Detail</a> |
                            <a href="{{ route('members.edit', $member) }}">Edit</a> |

                            <form action="{{ route('members.destroy', $member) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        style="background:none; border:none; color:#dc2626; cursor:pointer;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:20px; text-align:center;">
                            Belum ada data anggota.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $members->links() }}
    </div>

</div>

@endsection