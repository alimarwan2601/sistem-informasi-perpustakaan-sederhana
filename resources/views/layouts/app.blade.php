
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Perpustakaan')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #1e293b;
            color: white;
            padding: 25px 18px;
            flex-shrink: 0;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 35px;
            padding-left: 10px;
        }

        .menu-title {
            color: #94a3b8;
            font-size: 12px;
            margin: 20px 10px 10px;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #cbd5e1;
            padding: 12px 14px;
            margin-bottom: 5px;
            border-radius: 7px;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #334155;
            color: white;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            min-width: 0;
        }

        /* HEADER */
        .header {
            background: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .header h2 {
            font-size: 18px;
        }

        .user-info {
            font-size: 14px;
            color: #475569;
        }

        .content {
            padding: 30px;
        }

        /* DASHBOARD */
        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .page-heading p {
            color: #64748b;
            font-size: 14px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .stat-card p {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .stat-card h2 {
            font-size: 28px;
            color: #1e293b;
        }

        .content-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 22px;
        }

        .content-card h3 {
            margin-bottom: 12px;
        }

        .content-card p {
            color: #64748b;
            line-height: 1.6;
        }

        /* BUTTON */
        .logout-button {
            border: none;
            background: #fee2e2;
            color: #b91c1c;
            padding: 9px 13px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .logout-button:hover {
            background: #fecaca;
        }

        /* FOOTER */
        .footer {
            padding: 20px 30px;
            color: #94a3b8;
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 1000px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .app-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .header {
                padding: 18px;
                gap: 12px;
                flex-wrap: wrap;
            }

            .content {
                padding: 18px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="app-container">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="brand">
            Perpustakaan
        </div>

        <p class="menu-title">Menu Utama</p>

        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        @if (auth()->user()->role === 'admin')
            <p class="menu-title">Administrasi</p>
            <a href="#">Manajemen Pengguna</a>
        @endif

        <p class="menu-title">Data Perpustakaan</p>

        <a href="{{ route('categories.index') }}">Kategori</a>
        <a href="{{ route('books.index') }}">Data Buku</a>
        <a href="{{ route('members.index') }}">Data Anggota</a>

        <p class="menu-title">Transaksi</p>

        <a href="{{ route('borrowings.index') }}">Peminjaman Buku</a>
        <a href="{{ route('borrowings.index') }}">Pengembalian Buku</a>

    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main-content">

        <header class="header">

            <h2>@yield('header', 'Dashboard')</h2>

            <div class="user-info">
                {{ auth()->user()->name }}
                ({{ ucfirst(auth()->user()->role) }})

                <form action="{{ route('logout') }}"
                      method="POST"
                      style="display: inline; margin-left: 12px;">
                    @csrf

                    <button type="submit" class="logout-button">
                        Logout
                    </button>
                </form>
            </div>

        </header>

        <section class="content">
            @yield('content')
        </section>

        <footer class="footer">
            Sistem Informasi Perpustakaan Sederhana
            &copy; {{ date('Y') }}
        </footer>

    </main>

</div>

</body>
</html>
