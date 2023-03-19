<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->startOfString()
        ->get();

    expect($regex)->toBeString()
        ->toBe('/\A/mu');
});

it('returns the correct match', function () {
    $regex = FluentRegex::create("foo bar baz\nfoo bar baz")
        ->startOfString()
        ->exactly('f')
        ->match();

    expect($regex)->toBeArray()
        ->toBe(['f']);
});

it('returns the correct matches', function () {
    $regex = FluentRegex::create("foo bar baz\nfoo bar baz")
        ->startOfString()
        ->exactly('f')
        ->matchAll();

    expect($regex)->toBeArray()
        ->toBe([['f']]);
});
