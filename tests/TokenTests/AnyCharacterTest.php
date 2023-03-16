<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz');

    $regexString = $regex->anyCharacter()
        ->get();

    expect($regexString)->toBeString()
        ->toBe('/./');
});

it('returns the correct match', function () {
    $regex = FluentRegex::create('foo bar baz');

    $match = $regex->anyCharacter()
        ->match();

    expect($match)->toBeArray()
        ->toBe(['f']);
});


it('returns the correct matches', function () {
    $regex = FluentRegex::create('foo ');

    $matches = $regex->anyCharacter()
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([['f', 'o', 'o', ' ']]);
});
