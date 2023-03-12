<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foo bar baz FOO');
    $regexString = $regex->upperCaseLetter()->get();

    expect($regexString)
        ->toBeString()
        ->toBe('/[A-Z]/');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foo bar baz FOO');
    $match = $regex->upperCaseLetter()->match();

    expect($match)
        ->toBeArray()
        ->toBe(['F']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foo bar barry FOO');
    $matches = $regex->upperCaseLetter()->matchAll();

    expect($matches)
        ->toBeArray()
        ->toBe([['F', 'O', 'O']]);
});
