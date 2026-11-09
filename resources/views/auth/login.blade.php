
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 8px;
            color: #1e293b;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 17px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #1d4ed8;
        }

        .alert {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 7px;
            background: #dcfce7;
            color: #166534;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: -12px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Perpustakaan</h2>
        <p class="subtitle">Silakan login untuk melanjutkan</p>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email"
                required
                autofocus
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <div class="remember">
                <input type="checkbox" name="remember" id="remember" value="1">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
