<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foobar fuubar')
        ->exactly('foo')
        ->positiveLookBehind(function ($regex) {
            return $regex->exactly('bar');
        })
        ->get();

    expect($regex)->toBeString()
        ->toBe('/foo(?<=bar)/mu');
});

it('returns the correct match', function () {
    $match = FluentRegex::create('foobar fuubar')
        ->positiveLookBehind(function ($regex) {
            return $regex->exactly('foo');
        })
        ->exactly('bar')
        ->match();

    expect($match)->toBeArray()
        ->toBe(['bar']);
});

it('returns the correct matches', function () {
    $matches = FluentRegex::create('foobar fuubar foobar')
        ->positiveLookBehind(function ($regex) {
            return $regex->exactly('foo');
        })
        ->exactly('bar')
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([['bar', 'bar']]);
});
