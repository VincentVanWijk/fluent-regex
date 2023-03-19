<?php

declare(strict_types=1);

it('returns the correct regex', function () {
    $regex = \VincentVanWijk\FluentRegex\Facades\FluentRegex::create('foo bar baz')
        ->whitespace()
        ->get();

    expect($regex)->toBeString()
        ->toBe('/\s/mu');
});

it('returns the correct match', function () {
    $match = \VincentVanWijk\FluentRegex\Facades\FluentRegex::create('foo bar baz')
        ->whitespace()
        ->match();

    expect($match)->toBeArray()
        ->toBe([' ']);
});

it('returns the correct matches', function () {
    $matches = \VincentVanWijk\FluentRegex\Facades\FluentRegex::create('foo bar baz')
        ->whitespace()
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([[' ', ' ']]);
});
