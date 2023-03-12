<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foo bar baz FOO');
    $regexString = $regex->alphaNumeric()->get();

    expect($regexString)
        ->toBeString()
        ->toBe('/[a-zA-Z0-9]/');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('123 foo bar baz FOO');
    $match = $regex->alphaNumeric()->match();

    expect($match)
        ->toBeArray()
        ->toBe(['1']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('123 foo bar barry FOO');
    $matches = $regex->alphaNumeric()->matchAll();

    expect($matches)
        ->toBeArray()
        ->toBe([['1', '2', '3', 'f', 'o', 'o', 'b', 'a', 'r', 'b', 'a', 'r', 'r', 'y', 'F', 'O', 'O']]);
});
