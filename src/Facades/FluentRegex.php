<?php

namespace VincentVanWijk\FluentRegex\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \VincentVanWijk\FluentRegex\FluentRegex
 */
class FluentRegex extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \VincentVanWijk\FluentRegex\FluentRegex::class;
    }
}
