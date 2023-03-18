<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foo bar baz');

    $regex->exactly('foo')
        ->anyCharacterOf(' baz')
        ->captureGroup(function ($regex) {
            return $regex->exactly('bar')
                ->not->alphaNumeric()
                ->exactly('baz');
        });

    expect($regex->get())
        ->toBeString()
        ->toBe('/foo[ baz](bar[^a-zA-Z0-9]baz)/m');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foo bar baz');
    $match = $regex->exactly('foo')
        ->anyCharacterOf(' baz')
        ->captureGroup(function ($regex) {
            return $regex->exactly('bar')
                ->not->alphaNumeric()
                ->exactly('baz');
        })
        ->match();

    expect($match)
        ->toBeArray()
        ->toBe(['foo bar baz', 'bar baz']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foo bar baz');
    $matches = $regex->exactly('foo')
        ->anyCharacterOf(' baz')
        ->captureGroup(function ($regex) {
            return $regex->exactly('bar')
                ->not->alphaNumeric()
                ->exactly('baz');
        })
        ->matchAll();

    expect($matches)
        ->toBeArray()
        ->toBe([['foo bar baz'], ['bar baz']]);
});

it('escapes the correct characters', function () {
    $regex = new FluentRegex('foo bar baz');

    $regex->exactly('foo')
        ->anyCharacterOf(' baz!')
        ->captureGroup(function ($regex) {
            return $regex->exactly('bar{}')
                ->not->alphaNumeric()
                ->exactly('baz');
        });

    expect($regex->get())
        ->toBeString()
        ->toBe('/foo[ baz\!](bar\{\}[^a-zA-Z0-9]baz)/m');
});
