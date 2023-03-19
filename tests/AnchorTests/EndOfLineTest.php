<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create("foo bar baz\nfoo bar baz")
        ->endOfLine()
        ->get();

    expect($regex)->toBeString()->toBe('/$/mu');
});

it('returns the correct match', function () {
    $regex = FluentRegex::create("foo bar baz\nfoo bar baz")
        ->exactly('z')
        ->endOfLine()
        ->match();

    expect($regex)->toBeArray()->toBe(['z']);
});

it('returns the correct matches', function () {
    $regex = FluentRegex::create("foo bar baz\nfoo bar baz\nfoo bar baz")
        ->exactly('z')
        ->endOfLine()
        ->matchAll();

    expect($regex)->toBeArray()->toBe([['z', 'z', 'z']]);
});
