<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex as FluentRegexFacade;
use VincentVanWijk\FluentRegex\FluentRegex;

it('can be accessed via the Facade', function () {
    $regex = FluentRegexFacade::create('foo bar baz')
        ->anyCharacterOf('bar')
        ->get();

    expect($regex)
        ->toBeString()
        ->toBe('/[bar]/');
});

it('getting a random property throws an exception', function () {
    expect(function () {
        $regex = new FluentRegex('foo bar baz');
        $value = $regex->foo;
    })->toThrow(Exception::class, 'Property $foo does not exist.');
});

it('does not throw an exception when getting the not modifier', function () {
    expect(function () {
        $regex = new FluentRegex('foo bar baz');
        $regex->not->anyCharacterOf('bar');
    })->not->toThrow(Exception::class);
});

it('throws an exception when setting the not modifier', function () {
    expect(function () {
        $regex = new FluentRegex('foo bar baz');
        $regex->not = true;
    })->toThrow(Exception::class, 'Cannot set value of property $not.');
});

it('does not throw an exception when getting the lazy modifier', function () {
    expect(function () {
        $regex = new FluentRegex('foo bar baz');
        $regex->lazy->zeroOrMore('f');
    })->not->toThrow(Exception::class);
});

it('throws an exception when setting the lazy modifier', function () {
    expect(function () {
        $regex = new FluentRegex('foo bar baz');
        $regex->lazy = true;
    })->toThrow(Exception::class, 'Cannot set value of property $lazy.');
});
