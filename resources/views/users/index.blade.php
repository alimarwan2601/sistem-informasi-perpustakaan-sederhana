
@extends('layouts.app')

@section('title', 'Manajemen Pengguna')
@section('header', 'Manajemen Pengguna')

@section('content')

<div class="content-card">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div>
            <h2>Daftar Pengguna</h2>
            <p>Kelola akun admin dan petugas perpustakaan.</p>
        </div>

        <a href="{{ route('users.create') }}"
           style="background:#2563eb; color:white; padding:10px 15px; border-radius:6px; text-decoration:none;">
            + Tambah Pengguna
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

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f1f5f9; text-align:left;">
                    <th style="padding:12px;">No</th>
                    <th style="padding:12px;">Nama</th>
                    <th style="padding:12px;">Email</th>
                    <th style="padding:12px;">Role</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr style="border-bottom:1px solid #e2e8f0;">
                        <td style="padding:12px;">
                            {{ $users->firstItem() + $loop->index }}
                        </td>

                        <td style="padding:12px;">
                            {{ $user->name }}

                            @if ($user->id === auth()->id())
                                <small style="color:#64748b;">(Akun Anda)</small>
                            @endif
                        </td>

                        <td style="padding:12px;">{{ $user->email }}</td>

                        <td style="padding:12px;">
                            {{ ucfirst($user->role) }}
                        </td>

                        <td style="padding:12px; white-space:nowrap;">
                            <a href="{{ route('users.edit', $user) }}">Edit</a>

                            @if ($user->id !== auth()->id())
                                |

                                <form action="{{ route('users.destroy', $user) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            style="background:none; border:none; color:#dc2626; cursor:pointer;">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:20px; text-align:center;">
                            Belum ada pengguna.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $users->links() }}
    </div>

</div>

@endsection
