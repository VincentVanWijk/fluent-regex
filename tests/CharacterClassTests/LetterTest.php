<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foo bar baz FOO');
    $regexString = $regex->letter()->get();

    expect($regexString)
        ->toBeString()
        ->toBe('/[a-zA-Z]/');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foo bar baz FOO');
    $match = $regex->letter()->match();

    expect($match)
        ->toBeArray()
        ->toBe(['f']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foo bar! barry? FOO');
    $matches = $regex->letter()->matchAll();

    expect($matches)
        ->toBeArray()
        ->toBe([['f', 'o', 'o', 'b', 'a', 'r', 'b', 'a', 'r', 'r', 'y', 'F', 'O', 'O']]);
});
