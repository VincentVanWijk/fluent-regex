<?php

namespace VincentVanWijk\FluentRegex\Facades;

use Exception;
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

    /**
     * @throws Exception
     */
    public static function createFromFile(string $filePath = '', string $delimiter = '/'): \VincentVanWijk\FluentRegex\FluentRegex
    {
        $fileString = @file_get_contents($filePath);
        if ($fileString === false) {
            throw new Exception('Could not read file');
        }

        return new \VincentVanWijk\FluentRegex\FluentRegex($fileString, $delimiter);
    }
}
