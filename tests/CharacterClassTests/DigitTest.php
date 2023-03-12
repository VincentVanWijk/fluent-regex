<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foo bar baz FOO');
    $regexString = $regex->digit()->get();

    expect($regexString)
        ->toBeString()
        ->toBe('/[0-9]/');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('123 foo bar baz FOO');
    $match = $regex->digit()->match();

    expect($match)
        ->toBeArray()
        ->toBe(['1']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('123 foo bar barry FOO');
    $matches = $regex->digit()->matchAll();

    expect($matches)
        ->toBeArray()
        ->toBe([['1', '2', '3']]);
});
