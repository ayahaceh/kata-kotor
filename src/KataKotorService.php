<?php

namespace OmAlie\KataKotor;

class KataKotorService
{
    protected array $instances = [];

    public function __construct(array $languages)
    {
        foreach ($languages as $langClass) {
            if (class_exists($langClass)) {
                $keywords = $langClass::keywords();
                $this->instances[$langClass] = new KataKotor($keywords);
            }
        }
    }

    public function hasBadwords(string $text, string $lang = null): bool
    {
        foreach ($this->instances as $instance) {
            if ($instance->contains($text, $lang)) {
                return true;
            }
        }
        return false;
    }

    public function getBadwords(string $text, string $lang = null): array
    {
        $found = [];
        foreach ($this->instances as $instance) {
            $found = array_merge($found, $instance->find($text, $lang));
        }
        return array_unique($found);
    }

    public function censorText(string $text, string $replacement = '****', string $lang = null): string
    {
        foreach ($this->instances as $instance) {
            $text = $instance->censor($text, $replacement);
        }
        return $text;
    }
}