<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foobar barbar bazbar')
        ->negativeLookBehind(function ($regex) {
            return $regex->exactly('foo');
        })
        ->exactly('bar')
        ->get();

    expect($regex)->toBeString()
        ->toBe('/(?<!foo)bar/mu');
});

it('returns the correct match', function () {
    $match = FluentRegex::create('foobar barbar bazbar')
        ->negativeLookBehind(function ($regex) {
            return $regex->exactly('foo');
        })
        ->exactly('bar')
        ->match();

    expect($match)->toBeArray()
        ->toBe(['bar']);
});

it('returns the correct matches', function () {
    $matches = FluentRegex::create('foobar barbar bazbar')
        ->negativeLookBehind(function ($regex) {
            return $regex->exactly('foo');
        })
        ->exactly('bar')
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([['bar', 'bar', 'bar']]);
});
