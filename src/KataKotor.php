<?php

namespace OmAlie\KataKotor;

class KataKotor
{
    protected array $keywords;

    public function __construct(array $keywords)
    {
        $this->keywords = $keywords;
    }

    protected function cleanText(string $text): array
    {
        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('/[^a-z0-9\s]/u', ' ', $text);
        $text = preg_replace('/\s+/', ' ', $text);
        return explode(' ', trim($text));
    }

    public function contains(string $text): bool
    {
        $words = $this->cleanText($text);
        return (bool) array_intersect($this->keywords, $words);
    }

    public function find(string $text): array
    {
        $words = $this->cleanText($text);
        return array_values(array_intersect($this->keywords, $words));
    }

    public function censor(string $text, string $replacement = '****'): string
    {
        foreach ($this->keywords as $bad) {
            $pattern = '/\b'. preg_quote($bad, '/') .'\b/i';
            $text = preg_replace($pattern, $replacement, $text);
        }
        return $text;
    }
}