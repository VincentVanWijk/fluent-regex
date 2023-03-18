<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foo bar baz FOO');
    $regexString = $regex->lowerCaseLetter()->get();

    expect($regexString)
        ->toBeString()
        ->toBe('/[a-z]/m');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foo bar baz FOO');
    $match = $regex->lowerCaseLetter()->match();

    expect($match)
        ->toBeArray()
        ->toBe(['f']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foo bar barry FOO');
    $matches = $regex->lowerCaseLetter()->matchAll();

    expect($matches)
        ->toBeArray()
        ->toBe([['f', 'o', 'o', 'b', 'a', 'r', 'b', 'a', 'r', 'r', 'y']]);
});
