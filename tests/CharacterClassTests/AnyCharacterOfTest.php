<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex as FluentRegexFacade;
use VincentVanWijk\FluentRegex\FluentRegex;

it('returns the correct regex', function () {
    $regex = new FluentRegex('foo bar baz');
    $regexString = $regex->anyCharacterOf('bar')
        ->get();

    expect($regexString)->toBeString()
        ->toBe('/[bar]/mu');
});

it('returns the correct match', function () {
    $regex = new FluentRegex('foo bar baz');
    $match = $regex->anyCharacterOf('bar')
        ->match();

    expect($match)->toBeArray()
        ->toBe(['b']);
});

it('returns the correct matches', function () {
    $regex = new FluentRegex('foo bar baz');
    $matches = $regex->anyCharacterOf('bar')
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([['b', 'a', 'r', 'b', 'a']]);
});

it('escapes the correct characters', function () {
    $regex = new FluentRegex('foo bar baz');
    $regexString = $regex->anyCharacterOf('bar{}')
        ->get();

    expect($regexString)->toBeString()
        ->toBe('/[bar\{\}]/mu');
});

it('works with a callback and facade', function () {
    $regex = FluentRegexFacade::create('a{bc');
    $regexString = $regex->exactly('a')
        ->anyCharacterOf(function (FluentRegex $regex) {
            return $regex->exactly('{')
                ->lowerCaseLetter()
                ->digit();
        })
        ->oneOrMoreTimes()
        ->get();
    expect($regexString)->toBeString()
        ->toBe('/a[\{a-z\d]+/mu');
});
