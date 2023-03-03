<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function() {
    $regex = new FluentRegex('foobarbaz');

    $regex->exactly('foo')
        ->oneOrMore()
        ->exactly('barbaz');

    expect($regex->get())
        ->toBeString()
        ->toBe('/foo+barbaz/');
});

it('returns the correct match', function() {
    $regex = new FluentRegex('foooobarbaz');

    $match = $regex->exactly('foooo')
        ->oneOrMore()
        ->exactly('barbaz')
        ->match();

    expect($match)
        ->toBeArray()
        ->toBe(['foooobarbaz']);
});

it('returns the correct matches', function() {
    $regex = new FluentRegex('foobarbaz foooobarbaz');

    $match = $regex->exactly('fo')
        ->oneOrMore('o')
        ->exactly('barbaz')
        ->matchAll();

    expect($match)
        ->toBeArray()
        ->toBe([['foobarbaz', 'foooobarbaz']]);
});
