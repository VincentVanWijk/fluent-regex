<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->nonWhiteSpace()
        ->get();

    expect($regex)->toBeString()->toBe('/\S/mu');
});

it('returns the correct match', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->nonWhiteSpace()
        ->match();

    expect($regex)->toBeArray()->toBe(['f']);
});

it('returns the correct matches', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->nonWhiteSpace()
        ->matchAll();

    expect($regex)->toBeArray()->toBe([['f', 'o', 'o', 'b', 'a', 'r', 'b', 'a', 'z']]);
});
