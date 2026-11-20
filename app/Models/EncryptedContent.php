<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EncryptedContent extends Model
{
    protected $fillable = [
        'title',
        'encrypted_data',
        'nonce',
        'auth_tag',
        'encrypted_key',
        'algorithm',
        'created_by',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
