<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foobarbaz');

    $regex->exactly('foo')
        ->zeroOrOneTime()
        ->exactly('barbaz');

    expect($regex->get())
        ->toBeString()
        ->toBe('/foo?barbaz/m');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foobarbaz');

    $match = $regex->exactly('foo')
        ->zeroOrOneTime()
        ->exactly('barbaz')
        ->match();

    expect($match)
        ->toBeArray()
        ->toBe(['foobarbaz']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foobarbaz fobarbaz');

    $match = $regex->exactly('fo')
        ->zeroOrOneTime('o')
        ->exactly('barbaz')
        ->matchAll();

    expect($match)
        ->toBeArray()
        ->toBe([['foobarbaz', 'fobarbaz']]);
});
