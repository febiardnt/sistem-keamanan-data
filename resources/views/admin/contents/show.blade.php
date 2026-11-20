<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konten</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f1f5f9;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h2 {
            color: #1e293b;
        }

        .content {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .info {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('contents.index') }}">← Kembali ke Manajemen Konten</a>

    <h2>Detail Konten</h2>

    <div class="info">
        Data berhasil didekripsi menggunakan RSA-2048 dan AES-256-GCM.
    </div>

    <h3>Judul Konten</h3>
    <div class="content">{{ $decrypted['title'] }}</div>

    <h3>Isi Konten</h3>
    <div class="content">{{ $decrypted['content'] }}</div>

    <p><strong>Algoritma:</strong> {{ $content->algorithm }}</p>

</div>

</body>
</html>
