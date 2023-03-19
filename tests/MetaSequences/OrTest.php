<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foo bar baz');

    $regexString = $regex->or('foo', 'bar', 'baz')
        ->get();

    expect($regexString)->toBeString()
        ->toBe('/foo|bar|baz/mu');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foo bar baz');

    $match = $regex->or('foo', 'bar', 'baz')
        ->match();

    expect($match)->toBeArray()
        ->toBe(['foo']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foo bar baz');

    $matches = $regex->or('foo', 'bar', 'baz')
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([['foo', 'bar', 'baz']]);
});

it('escapes the correct characters', function () {
    $regex = new FluentRegex('foo bar baz');

    $regexString = $regex->or('foo', 'bar{}', 'baz')
        ->get();

    expect($regexString)->toBeString()
        ->toBe('/foo|bar\{\}|baz/mu');
});
