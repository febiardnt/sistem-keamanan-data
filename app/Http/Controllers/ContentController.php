<?php

namespace App\Http\Controllers;

use App\Models\EncryptedContent;
use App\Models\ActivityLog;
use App\Services\EncryptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    protected EncryptionService $encryption;

    public function __construct(EncryptionService $encryption)
    {
        $this->encryption = $encryption;
    }

    public function index()
    {
        $contents = EncryptedContent::latest()->get();

        return view('admin.contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.contents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $encrypted = $this->encryption->encrypt([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        EncryptedContent::create([
            'title' => 'Konten terenkripsi',
            'encrypted_data' => $encrypted['encrypted_data'],
            'nonce' => $encrypted['nonce'],
            'auth_tag' => $encrypted['auth_tag'],
            'encrypted_key' => $encrypted['encrypted_key'],
            'algorithm' => 'AES-256-GCM + RSA-2048',
            'created_by' => Auth::id(),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Enkripsi Data',
            'description' => 'Admin menambahkan dan mengenkripsi konten.',
            'ip_address' => $request->ip(),
        ]);

        return redirect()
            ->route('contents.index')
            ->with('success', 'Konten berhasil dienkripsi dan disimpan.');
    }

    public function show(EncryptedContent $content)
    {
        $decrypted = $this->encryption->decrypt(
            $content->only([
                'encrypted_data',
                'nonce',
                'auth_tag',
                'encrypted_key',
            ])
        );

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Dekripsi Data',
            'description' => 'Admin melihat konten yang telah didekripsi.',
            'ip_address' => request()->ip(),
        ]);

        return view('admin.contents.show', compact('content', 'decrypted'));
    }

    public function destroy(EncryptedContent $content)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Hapus Data',
            'description' => 'Admin menghapus konten terenkripsi.',
            'ip_address' => request()->ip(),
        ]);

        $content->delete();

        return redirect()
            ->route('contents.index')
            ->with('success', 'Konten berhasil dihapus.');
    }
}
