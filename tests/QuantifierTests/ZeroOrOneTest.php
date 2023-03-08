<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foobarbaz');

    $regex->exactly('foo')
        ->zeroOrOne()
        ->exactly('barbaz');

    expect($regex->get())
        ->toBeString()
        ->toBe('/foo?barbaz/');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foobarbaz');

    $match = $regex->exactly('foo')
        ->zeroOrOne()
        ->exactly('barbaz')
        ->match();

    expect($match)
        ->toBeArray()
        ->toBe(['foobarbaz']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foobarbaz fobarbaz');

    $match = $regex->exactly('fo')
        ->zeroOrOne('o')
        ->exactly('barbaz')
        ->matchAll();

    expect($match)
        ->toBeArray()
        ->toBe([['foobarbaz', 'fobarbaz']]);
});
