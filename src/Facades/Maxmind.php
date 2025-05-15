<?php

namespace MoveMoveApp\Maxmind\Facades;

use Illuminate\Support\Facades\Facade;
use MoveMoveApp\Maxmind\MaxmindService;

/**
 * @method static name(string[] $array)
 * @method static passport(string[] $array)
 * @method static email(string[] $array)
 * @method static carBrand(string[] $array)
 * @method static bank(string[] $array)
 * @method static bankById(string[] $array)
 */
class Maxmind extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return MaxmindService::class;
    }
}
