<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->startOfLine()
        ->get();

    expect($regex)->toBeString()
        ->toBe('/^/mu');
});

it('returns the correct match', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->startOfLine()
        ->match();

    expect($regex)->toBeArray()
        ->toBe(['']);
});

it('returns the correct matches', function () {
    $regex = FluentRegex::create('foo bar baz'.PHP_EOL.'foo bar baz')
        ->startOfLine()
        ->exactly('f')
        ->matchAll();

    expect($regex)->toBeArray()
        ->toBe([['f', 'f']]);
});
