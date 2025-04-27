# kata-kotor
Kata Kotor - Laravel Badwords Filter, Multi Languages support.

**Kata Kotor** adalah paket Laravel untuk deteksi dan filter kata-kata kotor dalam berbagai bahasa. Super Ringan, mudah digunakan, dan mendukung Laravel 8, 9, 10, dan 11.

---

## Fitur

- Deteksi kata kotor dari teks input
- Multi-bahasa dan Sub Bahasa Daerah (Indonesia, Inggris, Indonesia-Jawa, Indonesia-Aceh, dll.)
- Pilih bahasa default atau override saat runtime
- Mudah ditambahkan kata baru
- PSR-4 autoload, ServiceProvider, Facade, dan file konfigurasi yang dapat di-publish

---

## Cara Install

```bash
composer require omalie/kata-kotor
```

---

## Konfigurasi

Setelah meng-install, publikasikan file konfigurasi:

```bash
php artisan vendor:publish --tag=kata-kotor-config
```

File konfigurasi akan terbuat di `config/kata-kotor.php`:

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Language
    |--------------------------------------------------------------------------
    |
    | Bahasa default untuk memfilter kata kotor. Contoh: 'id' = Indonesia,
    | 'en' = English. Bisa di-override saat penggunaan.
    |
    */
    'default_language' => 'id',
];
```

---

## Struktur Project

```text
kata-kotor/
├── composer.json
├── README.md
├── LICENSE
├── config/
│   └── kata-kotor.php
├── resources/
│   └── badwords/
│       ├── id.txt
│       └── en.txt
└── src/
    ├── Facades/
    │   └── KataKotor.php
    ├── KataKotor.php
    ├── KataKotorService.php
    └── KataKotorServiceProvider.php
```

---

## Penggunaan

### 1. Cek apakah teks mengandung kata kotor

```php
use OmAlie\KataKotor\Facades\KataKotor;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        if (KataKotor::hasBadwords($message)) {
            return response()->json([
                'error' => 'Message has bad word!'
            ], 400);
        }

        // Lanjut proses...
    }
}
```

### 2. Ambil daftar kata kotor yang ditemukan

```php
$found = KataKotor::getBadwords($message);
// Hasil: ['bodoh', 'goblok']
```

### 3. Censor teks

```php
$clean = KataKotor::censorText($message, '****');
// Semua kata kotor diganti dengan ****
```

### 4. Override Bahasa (opsional)

```php
// Deteksi dalam bahasa Inggris
$hasEn = KataKotor::hasBadwords($message, 'en');
```

---

## Sumber Kata Kotor

- `resources/badwords/id.txt` (Bahasa Indonesia)
- `resources/badwords/en.txt` (Bahasa Inggris)
- `resources/badwords/id-jv.txt` (Bahasa Jawa, Indonesia)
- `resources/badwords/id-ace.txt` (Bahasa Aceh, Indonesia)

Isi `id.txt` dan `en.txt` dapat diperluas sesuai kebutuhan.
#### Penambahan bahasa baru
untuk menambah bahasa baru, tambahkan file bahasa di folder ini, dengan penamaan file bahasa mengikuti standar Internasional dengan format `BCP 47`
---

## License

MIT License — Bebas digunakan untuk projek pribadi maupun komersial.

---

## Kontribusi

Pull request ditunggu untuk:

- Menambahkan bahasa baru
Penamaan file bahasa mengikuti standar internasional format `BCP 47`. Contoh `id-ace` untuk Bahasa Aceh, atau `id-jv` untuk Bahasa Jawa.
- Memperluas daftar kata kotor
- Perbaikan dan optimasi

Terima kasih! 🙌
