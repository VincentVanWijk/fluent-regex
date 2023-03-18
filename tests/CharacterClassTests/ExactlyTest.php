<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foo bar baz');
    $regexString = $regex->exactly('bar')
        ->get();

    expect($regexString)
        ->toBeString()
        ->toBe('/bar/m');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foo bar baz');
    $match = $regex->exactly('bar')
        ->match();

    expect($match)
        ->toBeArray()
        ->toBe(['bar']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foo bar barry');
    $matches = $regex->exactly('bar')
        ->matchAll();

    expect($matches)
        ->toBeArray()
        ->toBe([['bar', 'bar']]);
});

it('escapes the correct characters', function () {
    $regex = new FluentRegex('foo bar.* baz');

    $matches = $regex->exactly('bar.*')
        ->matchAll();

    expect($matches)
        ->toBeArray()
        ->toBe([['bar.*']]);

    $regexString = $regex->get();
    expect($regexString)
        ->toBe('/bar\.\*/m');
});
