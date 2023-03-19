<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->nonWordBoundary()
        ->get();

    expect($regex)->toBeString()
        ->toBe('/\B/mu');
});

it('returns the correct match', function () {
    $match = FluentRegex::create('foo bar baz')
        ->exactly('a')
        ->nonWordBoundary()
        ->match();

    expect($match)->toBeArray()
        ->toBe(['a']);
});

it('returns the correct matches', function () {
    $matches = FluentRegex::create('foo bar baza')
        ->exactly('a')
        ->nonWordBoundary()
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([['a', 'a']]);
});
