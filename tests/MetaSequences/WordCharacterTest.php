<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar 123')
        ->wordCharacter()
        ->get();

    expect($regex)->toBeString()->toBe('/\w/mu');
});

it('returns the correct regex with the not operator', function () {
    $regex = FluentRegex::create('foo bar 123')
        ->not->wordCharacter()
        ->get();

    expect($regex)->toBeString()->toBe('/\W/mu');
});

it('returns the correct match', function () {
    $regex = FluentRegex::create('foo bar 123')
        ->wordCharacter()
        ->match();

    expect($regex)->toBeArray()->toBe(['f']);
});

it('returns the correct match with the not operator', function () {
    $regex = FluentRegex::create('foo bar 123')
        ->not->wordCharacter()
        ->match();

    expect($regex)->toBeArray()->toBe([' ']);
});

it('returns the correct matches', function () {
    $regex = FluentRegex::create('foo 123 _')
        ->wordCharacter()
        ->matchAll();

    expect($regex)->toBeArray()->toBe([['f', 'o', 'o', '1', '2', '3', '_']]);
});

it('returns the correct matches with the not operator', function () {
    $regex = FluentRegex::create('foo bar 123')
        ->not->wordCharacter()
        ->matchAll();

    expect($regex)->toBeArray()->toBe([[' ', ' ']]);
});
