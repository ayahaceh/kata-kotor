<?php

namespace OmAlie\KataKotor\Facades;

use Illuminate\Support\Facades\Facade;

class KataKotor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return KataKotorService::class;
    }
}