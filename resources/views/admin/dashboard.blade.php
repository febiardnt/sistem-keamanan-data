<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Keamanan Data</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .sidebar {
            position: fixed;
            width: 240px;
            height: 100vh;
            background: #172554;
            color: white;
            padding: 25px 18px;
        }

        .sidebar h2 {
            font-size: 19px;
            margin-bottom: 35px;
        }

        .sidebar a {
            display: block;
            color: #dbeafe;
            text-decoration: none;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar a:hover,
        .active {
            background: #2563eb;
        }

        .main {
            margin-left: 240px;
            padding: 30px;
        }

        .header h1 { margin: 0; }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0000000a;
        }

        .card h3 {
            color: #64748b;
            font-size: 14px;
        }

        .card strong {
            font-size: 27px;
            color: #1d4ed8;
        }

        .content {
            background: white;
            margin-top: 25px;
            padding: 25px;
            border-radius: 12px;
            line-height: 1.7;
        }

        .status {
            color: #15803d;
        }

        button {
            border: 0;
            padding: 10px 16px;
            border-radius: 7px;
            background: #dc2626;
            color: white;
            cursor: pointer;
        }

        @media(max-width: 650px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <h2>🔐 Keamanan Data</h2>

    <a href="{{ route('dashboard') }}" class="active">
        Dashboard
    </a>

    <a href="{{ route('contents.index') }}">
        Manajemen Konten
    </a>

    <a href="{{ route('contents.create') }}">
        Enkripsi Data
    </a>

    <a href="{{ route('activity-logs.index') }}">
        Riwayat Aktivitas
    </a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</aside>

<main class="main">

    <div class="header">
        <div>
            <h1>Dashboard Admin</h1>
            <p>
                Selamat datang di Sistem Informasi Keamanan Data.
            </p>
        </div>
    </div>

    <section class="cards">

        <div class="card">
            <h3>Total Konten Terenkripsi</h3>
            <strong>
                {{ \App\Models\EncryptedContent::count() }}
            </strong>
        </div>

        <div class="card">
            <h3>Total Aktivitas Admin</h3>
            <strong>
                {{ \App\Models\ActivityLog::count() }}
            </strong>
        </div>

        <div class="card">
            <h3>Algoritma Simetris</h3>
            <strong>AES-256</strong>
        </div>

        <div class="card">
            <h3>Algoritma Asimetris</h3>
            <strong>RSA-2048</strong>
        </div>

    </section>

    <section class="content">
        <h2>Informasi Keamanan Sistem</h2>

        <p>
            Sistem menggunakan algoritma AES-256-GCM
            untuk mengenkripsi data konten.
        </p>

        <p>
            Algoritma RSA-2048 digunakan untuk melindungi
            kunci enkripsi AES agar keamanan data lebih terjaga.
        </p>

        <p>
            Setiap aktivitas admin seperti enkripsi, dekripsi,
            dan penghapusan data dicatat dalam riwayat aktivitas.
        </p>

        <p>
            Status Sistem:
            <strong class="status">Aktif</strong>
        </p>
    </section>

</main>

</body>
</html>
