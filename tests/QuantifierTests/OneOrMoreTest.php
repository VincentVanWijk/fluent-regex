<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foobarbaz');

    $regex->exactly('foo')
        ->oneOrMoreTimes()
        ->exactly('barbaz');

    expect($regex->get())
        ->toBeString()
        ->toBe('/foo+barbaz/m');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foooobarbaz');

    $match = $regex->exactly('foooo')
        ->oneOrMoreTimes()
        ->exactly('barbaz')
        ->match();

    expect($match)
        ->toBeArray()
        ->toBe(['foooobarbaz']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foobarbaz foooobarbaz');

    $match = $regex->exactly('fo')
        ->oneOrMoreTimes('o')
        ->exactly('barbaz')
        ->matchAll();

    expect($match)
        ->toBeArray()
        ->toBe([['foobarbaz', 'foooobarbaz']]);
});
