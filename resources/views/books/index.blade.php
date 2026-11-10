 @extends('layouts.app')

@section('title', 'Data Buku')
@section('header', 'Data Buku')

@section('content')

<div class="content-card">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h2>Daftar Buku</h2>
            <p>Kelola seluruh data buku perpustakaan.</p>
        </div>

        <a href="{{ route('books.create') }}"
           style="background: #2563eb; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none;">
            + Tambah Buku
        </a>
    </div>

    @if (session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 12px; border-radius: 6px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 15px;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('books.index') }}" method="GET" style="margin-bottom: 20px;">
        <input
            type="text"
            name="search"
            placeholder="Cari judul, penulis, atau ISBN..."
            value="{{ request('search') }}"
            style="padding: 10px; width: 280px; border: 1px solid #cbd5e1; border-radius: 6px;"
        >

        <button type="submit"
                style="padding: 10px 15px; background: #334155; color: white; border: none; border-radius: 6px;">
            Cari
        </button>

        <a href="{{ route('books.index') }}">Reset</a>
    </form>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f1f5f9; text-align: left;">
                    <th style="padding: 12px;">No</th>
                    <th style="padding: 12px;">Judul Buku</th>
                    <th style="padding: 12px;">Penulis</th>
                    <th style="padding: 12px;">Kategori</th>
                    <th style="padding: 12px;">Tahun</th>
                    <th style="padding: 12px;">Stok</th>
                    <th style="padding: 12px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($books as $book)
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 12px;">
                            {{ $books->firstItem() + $loop->index }}
                        </td>

                        <td style="padding: 12px;">
                            {{ $book->title }}
                        </td>

                        <td style="padding: 12px;">
                            {{ $book->author }}
                        </td>

                        <td style="padding: 12px;">
                            {{ $book->category->name ?? '-' }}
                        </td>

                        <td style="padding: 12px;">
                            {{ $book->publication_year ?? '-' }}
                        </td>

                        <td style="padding: 12px;">
                            {{ $book->stock }}
                        </td>

                        <td style="padding: 12px; white-space: nowrap;">
                            <a href="{{ route('books.show', $book) }}">Detail</a> |

                            <a href="{{ route('books.edit', $book) }}">Edit</a> |

                            <form action="{{ route('books.destroy', $book) }}"
                                  method="POST"
                                  style="display: inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        style="background: none; border: none; color: #dc2626; cursor: pointer;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 20px; text-align: center;">
                            Belum ada data buku.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $books->links() }}
    </div>

</div>

@endsection
