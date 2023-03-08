<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('fooobarbaz');

    $regex->exactly('fo')
        ->nTimes(3)
        ->exactly('barbaz');

    expect($regex->get())
        ->toBeString()
        ->toBe('/fo{3}barbaz/');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('fooobarbaz');

    $match = $regex->exactly('fo')
        ->nTimes(3)
        ->exactly('barbaz')
        ->match();

    expect($match)
        ->toBeArray()
        ->toBe(['fooobarbaz']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('fooobarbaz foooobarbaz');

    $match = $regex->exactly('fo')
        ->nTimes(3)
        ->exactly('barbaz')
        ->matchAll();

    expect($match)
        ->toBeArray()
        ->toBe([['fooobarbaz']]);
});
