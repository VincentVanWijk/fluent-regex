<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz')
        ->newLine()
        ->get();

    expect($regex)->toBeString()
        ->toBe('/\R/mu');
});

it('returns the correct match', function () {
    $match = FluentRegex::create("foo bar baz\nfoo bar baz")
        ->newLine()
        ->exactly('f')
        ->match();

    expect($match)->toBeArray()
        ->toBe(["\nf"]);
});

it('returns the correct matches', function () {
    $matches = FluentRegex::create("foo bar baz\nfoo bar baz\nfoo bar baz")
        ->newLine()
        ->exactly('f')
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([["\nf", "\nf"]]);
});
