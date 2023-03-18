<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->tabCharacter()
        ->get();

    expect($regex)->toBeString()
        ->toBe('/\t/m');
});

it('returns the correct match', function () {
    $match = FluentRegex::create("foo bar\tbaz")
        ->tabCharacter()
        ->exactly('b')
        ->match();

    expect($match)->toBeArray()
        ->toBe(["\tb"]);
});

it('returns the correct matches', function () {
    $matches = FluentRegex::create("foo bar\tbaz\tfoo bar baz")
        ->tabCharacter()
        ->anyCharacter()
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([["\tb", "\tf"]]);
});
