<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Language
    |--------------------------------------------------------------------------
    |
    | Ini adalah bahasa utama yang akan digunakan oleh library ini
    | untuk mendeteksi kata-kata kotor. Kamu bisa ganti ke English
    | atau bahasa custom lain kalau mau.
    |
    */

    'default_language' => \OmAlie\KataKotor\Languages\BahasaIndonesia::class,

    /*
    |--------------------------------------------------------------------------
    | Additional Languages
    |--------------------------------------------------------------------------
    |
    | Kalau kamu mau menambahkan lebih dari satu bahasa untuk deteksi
    | kata kotor, daftarkan di array ini.
    |
    */

    'additional_languages' => [
        // \OmAlie\KataKotor\Languages\English::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Whitelist
    |--------------------------------------------------------------------------
    |
    | Daftar kata-kata yang akan diabaikan (tidak dianggap kotor),
    | walaupun mungkin terdeteksi sebagai kata kasar di bahasa manapun.
    |
    */

    'whitelist' => [
        // 'kentang',
    ],
];
