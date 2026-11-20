<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encrypted_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('encrypted_data');
            $table->text('nonce');
            $table->text('auth_tag');
            $table->longText('encrypted_key');
            $table->string('algorithm')->default('AES-256-GCM + RSA');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encrypted_contents');
    }
};
