<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Konten</title>

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
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h2 {
            color: #1e293b;
        }

        label {
            display: block;
            margin: 18px 0 8px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
        }

        textarea {
            min-height: 180px;
            resize: vertical;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .back {
            color: #2563eb;
            text-decoration: none;
        }

        .error {
            color: #dc2626;
            margin-top: 5px;
        }

        .info {
            background: #eff6ff;
            padding: 12px;
            border-radius: 6px;
            color: #1e40af;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('contents.index') }}" class="back">
        ← Kembali
    </a>

    <h2>Tambah Konten</h2>
    <p>Masukkan data yang akan disimpan dalam bentuk terenkripsi.</p>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('contents.store') }}" method="POST">
        @csrf

        <label>Judul Konten</label>
        <input
            type="text"
            name="title"
            value="{{ old('title') }}"
            placeholder="Masukkan judul konten"
            required
        >

        <label>Isi Konten</label>
        <textarea
            name="content"
            placeholder="Masukkan isi konten"
            required
        >{{ old('content') }}</textarea>

        <div class="info">
            <strong>Keamanan:</strong>
            Konten akan dienkripsi menggunakan AES-256-GCM.
            Kunci AES akan dilindungi menggunakan RSA-2048.
        </div>

        <button type="submit">Enkripsi dan Simpan</button>
    </form>

</div>

</body>
</html>
