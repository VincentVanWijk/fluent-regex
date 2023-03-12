<?php

namespace VincentVanWijk\FluentRegex\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \VincentVanWijk\FluentRegex\FluentRegex
 */
class FluentRegex extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \VincentVanWijk\FluentRegex\FluentRegex::class;
    }

    public static function create(string $subject = '', string $delimiter = '/'): \VincentVanWijk\FluentRegex\FluentRegex
    {
        return new \VincentVanWijk\FluentRegex\FluentRegex($subject, $delimiter);
    }
}
