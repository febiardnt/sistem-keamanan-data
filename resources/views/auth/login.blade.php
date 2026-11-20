<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Keamanan Data</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e40af);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: white;
            width: 380px;
            max-width: 90%;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 15px 40px #0004;
        }
        h2 { color: #1e3a8a; text-align: center; }
        p { color: #64748b; text-align: center; }
        label { display: block; margin: 18px 0 7px; }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }
        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            border: none;
            border-radius: 8px;
            color: white;
            background: #2563eb;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover { background: #1d4ed8; }
        .error { color: #dc2626; text-align: left; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>🔐 Sistem Keamanan Data</h2>
        <p>Silakan login sebagai admin</p>

        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <label>Email</label>
            <input type="email" name="email"
                   placeholder="Masukkan email" required>

            <label>Password</label>
            <input type="password" name="password"
                   placeholder="Masukkan password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
