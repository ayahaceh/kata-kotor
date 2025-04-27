<?php

namespace OmAlie\KataKotor;

use Illuminate\Support\Facades\Config;

class KataKotorService
{
    /**
     * Daftar bahasa yang digunakan untuk pengecekan kata-kata kotor.
     *
     * @var array
     */
    protected $languages;

    /**
     * Konstruktor untuk mendeteksi dan memuat bahasa.
     *
     * @param array $languages
     */
    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * Fungsi untuk mengecek apakah sebuah kata termasuk kata kotor.
     *
     * @param string $word
     * @return bool
     */
    public function isKataKotor(string $word): bool
    {
        foreach ($this->languages as $language) {
            $languageInstance = new $language;

            // Mengecek apakah kata ada di dalam bahasa yang di-load
            if ($languageInstance->isKataKotor($word)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Mendapatkan daftar bahasa yang di-load dari konfigurasi.
     *
     * @return array
     */
    public static function getLanguages(): array
    {
        $defaultLanguage = Config::get('kata-kotor.default_language');
        $additionalLanguages = Config::get('kata-kotor.additional_languages', []);

        // Menyusun daftar bahasa
        return array_merge([$defaultLanguage], $additionalLanguages);
    }

    /**
     * Fungsi untuk mendapatkan whitelist dari konfigurasi.
     *
     * @return array
     */
    public static function getWhitelist(): array
    {
        return Config::get('kata-kotor.whitelist', []);
    }
}
