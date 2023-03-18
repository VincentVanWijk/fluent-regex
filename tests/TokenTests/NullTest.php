<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->nullCharacter()
        ->get();

    expect($regex)->toBeString()
        ->toBe('/\0/m');
});

it('returns the correct match', function () {
    $match = FluentRegex::create("foo bar\0baz")
        ->nullCharacter()
        ->exactly('b')
        ->match();

    expect($match)->toBeArray()
        ->toBe(["\0b"]);
});

it('returns the correct matches', function () {
    $matches = FluentRegex::create("foo bar\0baz\0foo bar baz")
        ->nullCharacter()
        ->anyCharacter()
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([["\0b", "\0f"]]);
});
