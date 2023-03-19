<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->wordBoundary()
        ->get();

    expect($regex)->toBeString()
        ->toBe('/\b/mu');
});

it('returns the correct match', function () {
    $match = FluentRegex::create('foo bar baz')
        ->exactly('r')
        ->wordBoundary()
        ->match();

    expect($match)->toBeArray()
        ->toBe(['r']);
});

it('returns the correct matches', function () {
    $matches = FluentRegex::create('foo bar baz')
        ->exactly('a')
        ->anyCharacter()
        ->wordBoundary()
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([['ar', 'az']]);
});
