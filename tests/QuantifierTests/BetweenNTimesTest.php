<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('fbarbaz fffbarbaz fffffbarbaz ffffffbarbaz fffffffffffffbarbaz');

    $regex->exactly(' f')
        ->betweenNTimes(3, 6)
        ->exactly('barbaz');

    expect($regex->get())
        ->toBeString()
        ->toBe('/ f{3,6}barbaz/mu');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('fbarbaz fffbarbaz fffffbarbaz ffffffbarbaz fffffffffffffbarbaz');

    $match = $regex->exactly('f')
        ->betweenNTimes(3, 6)
        ->exactly('barbaz')
        ->match();

    expect($match)
        ->toBeArray()
        ->toBe(['fffbarbaz']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('fbarbaz fffbarbaz fffffbarbaz ffffffbarbaz fffffffffffffbarbaz');

    $match = $regex->exactly(' f')
        ->betweenNTimes(3, 6)
        ->exactly('barbaz')
        ->matchAll();
    expect($match)
        ->toBeArray()
        ->toBe([[' fffbarbaz', ' fffffbarbaz', ' ffffffbarbaz']]);
});
