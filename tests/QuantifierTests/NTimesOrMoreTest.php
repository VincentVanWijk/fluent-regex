<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('fooobarbaz');

    $regex->exactly('f')
        ->nTimesOrMore(3)
        ->exactly('barbaz');

    expect($regex->get())
        ->toBeString()
        ->toBe('/f{3,}barbaz/');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('fffffffbarbaz fooobarbaz');

    $match = $regex->exactly('f')
        ->nTimesOrMore(3)
        ->exactly('barbaz')
        ->match();

    expect($match)
        ->toBeArray()
        ->toBe(['fffffffbarbaz']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('fffffffffffbarbaz fffbarbaz foobarbaz');

    $match = $regex->exactly('f')
        ->nTimesOrMore(3)
        ->exactly('barbaz')
        ->matchAll();

    expect($match)
        ->toBeArray()
        ->toBe([['fffffffffffbarbaz', 'fffbarbaz']]);
});
