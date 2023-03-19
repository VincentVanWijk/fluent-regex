<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foobarbaz');

    $regex->exactly('foo')
        ->zeroOrMoreTimes()
        ->exactly('barbaz');

    expect($regex->get())
        ->toBeString()
        ->toBe('/foo*barbaz/mu');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foooobarbaz');

    $match = $regex->exactly('foo')
        ->zeroOrMoreTimes()
        ->exactly('barbaz')
        ->match();

    expect($match)
        ->toBeArray()
        ->toBe(['foooobarbaz']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('fbarbaz fobarbaz foooobarbaz');

    $match = $regex->exactly('f')
        ->zeroOrMoreTimes('o')
        ->exactly('barbaz')
        ->matchAll();

    expect($match)
        ->toBeArray()
        ->toBe([['fbarbaz', 'fobarbaz', 'foooobarbaz']]);
});
