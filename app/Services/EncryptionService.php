<?php

namespace App\Services;

class EncryptionService
{
    // Mengenkripsi data menggunakan AES-256-GCM
    public function encrypt(array $data): array
    {
        $publicKey = file_get_contents(
            storage_path('app/keys/public.pem')
        );

        $aesKey = random_bytes(32);
        $nonce = random_bytes(12);

        $plaintext = json_encode($data);

        $ciphertext = openssl_encrypt(
            $plaintext,
            'aes-256-gcm',
            $aesKey,
            OPENSSL_RAW_DATA,
            $nonce,
            $tag
        );

        if ($ciphertext === false) {
            throw new \RuntimeException('Enkripsi AES gagal.');
        }

        // Melindungi kunci AES menggunakan RSA
        $success = openssl_public_encrypt(
            $aesKey,
            $encryptedKey,
            $publicKey,
            OPENSSL_PKCS1_OAEP_PADDING
        );

        if (!$success) {
            throw new \RuntimeException('Enkripsi kunci RSA gagal.');
        }

        return [
            'encrypted_data' => base64_encode($ciphertext),
            'nonce' => base64_encode($nonce),
            'auth_tag' => base64_encode($tag),
            'encrypted_key' => base64_encode($encryptedKey),
        ];
    }

    // Membuka kembali data menggunakan RSA dan AES
    public function decrypt(array $content): array
    {
        $privateKey = file_get_contents(
            storage_path('app/keys/private.pem')
        );

        // Membuka kunci AES menggunakan RSA
        $success = openssl_private_decrypt(
            base64_decode($content['encrypted_key']),
            $aesKey,
            $privateKey,
            OPENSSL_PKCS1_OAEP_PADDING
        );

        if (!$success) {
            throw new \RuntimeException('Dekripsi kunci RSA gagal.');
        }

        // Membuka data menggunakan AES
        $plaintext = openssl_decrypt(
            base64_decode($content['encrypted_data']),
            'aes-256-gcm',
            $aesKey,
            OPENSSL_RAW_DATA,
            base64_decode($content['nonce']),
            base64_decode($content['auth_tag'])
        );

        if ($plaintext === false) {
            throw new \RuntimeException('Dekripsi AES gagal.');
        }

        return json_decode($plaintext, true);
    }
}
