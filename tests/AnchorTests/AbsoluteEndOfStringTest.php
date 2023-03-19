<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz baz')
        ->absoluteEndOfString()
        ->get();

    expect($regex)->toBeString()->toBe('/\z/mu');
});

it('returns the correct match', function () {
    $regex = FluentRegex::create("foo bar baz\n foo bar baz")
        ->exactly('z')
        ->absoluteEndOfString()
        ->match();

    expect($regex)->toBeArray()->toBe(['z']);
});

it('returns the correct matches', function () {
    $regex = FluentRegex::create("foo bar baz\n foo bar baz")
        ->exactly('z')
        ->absoluteEndOfString()
        ->matchAll();

    expect($regex)->toBeArray()->toBe([['z']]);
});
