<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex as FluentRegexFacade;
use VincentVanWijk\FluentRegex\FluentRegex;

it('can be accessed via the Facade', function () {
    $facadeClass = FluentRegexFacade::getFacadeRoot();

    expect($facadeClass)
        ->toBeInstanceOf(FluentRegex::class);

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
        $regex->lazy->zeroOrMoreTimes('f');
    })->not->toThrow(Exception::class);
});

it('throws an exception when setting the lazy modifier', function () {
    expect(function () {
        $regex = new FluentRegex('foo bar baz');
        $regex->lazy = true;
    })->toThrow(Exception::class, 'Cannot set value of property $lazy.');
});

it('returns a string', function () {
    $regex = new FluentRegex('foo bar baz');
    $regexString = $regex->exactly('bar')
        ->get();

    expect($regexString)
        ->toBeString();
});

it('returns a non empty string', function () {
    $regex = new FluentRegex('foo bar baz');
    $regexString = $regex->exactly('bar')
        ->get();

    expect($regexString)
        ->toBe('/bar/');
});

it('returns the correct delimiter', function () {
    $regex = new FluentRegex('foo bar baz');
    $regexString = $regex->exactly('bar')
        ->get();

    expect($regexString)
        ->toBe('/bar/');

    $regex = new FluentRegex('foo bar baz', '#');
    $regexString = $regex->exactly('b#a#r')
        ->get();

    expect($regexString)
        ->toBe('#b\#a\#r#');
});

it('returns the correct raw regex', function () {
    $regex = new FluentRegex('foo bar baz');
    $regexString = $regex->raw('[bar]?')
        ->get();

    expect($regexString)
        ->toBe('/[bar]?/');
});
