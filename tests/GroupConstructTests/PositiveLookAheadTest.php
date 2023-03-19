<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foobar foobaz')
        ->exactly('foo')
        ->positiveLookAhead(function ($regex) {
            return $regex->exactly('bar');
        })
        ->get();

    expect($regex)->toBeString()
        ->toBe('/foo(?=bar)/mu');
});

it('returns the correct match', function () {
    $match = FluentRegex::create('foobar foobaz')
        ->exactly('foo')
        ->positiveLookAhead(function ($regex) {
            return $regex->exactly('bar');
        })
        ->match();

    expect($match)->toBeArray()
        ->toBe(['foo']);
});

it('returns the correct matches', function () {
    $matches = FluentRegex::create('foobar foobaz')
        ->exactly('foo')
        ->positiveLookAhead(function ($regex) {
            return $regex->exactly('bar');
        })
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([['foo']]);
});
