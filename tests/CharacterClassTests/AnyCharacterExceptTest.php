<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foo bar baz');

    $regexString = $regex->not->anyCharacterOf('bar')
        ->get();

    expect($regexString)->toBeString()
        ->toBe('/[^bar]/mu');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foo bar baz');
    $match = $regex->not->anyCharacterOf('bar')
        ->match();

    expect($match)->toBeArray()
        ->toBe(['f']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foo bar baz');
    $matches = $regex->not->anyCharacterOf('bar')
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([['f', 'o', 'o', ' ', ' ', 'z']]);
});

it('escapes the correct characters', function () {
    $regex = new FluentRegex('foo bar baz');

    $regexString = $regex->not->anyCharacterOf('bar{}')
        ->get();

    expect($regexString)->toBeString()
        ->toBe('/[^bar\{\}]/mu');
});
