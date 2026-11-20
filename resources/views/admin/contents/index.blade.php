<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Konten</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f1f5f9;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h2 {
            color: #1e293b;
        }

        .button {
            display: inline-block;
            padding: 10px 16px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #eff6ff;
        }

        .success {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            margin-bottom: 15px;
            border-radius: 6px;
        }

        .action {
            color: #2563eb;
            margin-right: 10px;
        }

        .delete {
            color: #dc2626;
            border: none;
            background: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manajemen Konten</h2>
    <p>Data konten dilindungi menggunakan AES-256-GCM dan RSA-2048.</p>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('contents.create') }}" class="button">
        + Tambah Konten
    </a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Status</th>
                <th>Algoritma</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($contents as $content)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>Terenkripsi</td>
                    <td>{{ $content->algorithm }}</td>
                    <td>{{ $content->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a class="action"
                           href="{{ route('contents.show', $content->id) }}">
                            Lihat
                        </a>

                        <form action="{{ route('contents.destroy', $content->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="delete"
                                    onclick="return confirm('Hapus konten ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada konten tersimpan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
