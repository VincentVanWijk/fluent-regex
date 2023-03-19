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
        ->toBe('/[bar]/mu');
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
        ->toBe('/bar/mu');
});

it('returns the correct delimiter', function () {
    $regex = new FluentRegex('foo bar baz');
    $regexString = $regex->exactly('bar')
        ->get();

    expect($regexString)
        ->toBe('/bar/mu');

    $regex = new FluentRegex('foo bar baz', '#');
    $regexString = $regex->exactly('b#a#r')
        ->get();

    expect($regexString)
        ->toBe('#b\#a\#r#mu');
});

it('returns the correct raw regex', function () {
    $regex = new FluentRegex('foo bar baz');
    $regexString = $regex->raw('[bar]?')
        ->get();

    expect($regexString)
        ->toBe('/[bar]?/mu');
});

it('works when creating with a file', function () {
    $regex = FluentRegexFacade::createFromFile(__DIR__.'/../_TestFiles/testTXTfile.txt')
        ->exactly('FRY');

    expect($regex->get())
        ->toBeString()
        ->toBe('/FRY/mu')
        ->and($regex->match())
        ->toBeArray()
        ->toBe(['FRY']);
});

it('throws an exception when creating with a file that does not exist', function () {
    expect(function () {
        $regex = FluentRegexFacade::createFromFile(__DIR__.'/../_TestFiles/doesNotExist.txt');
    })->toThrow(Exception::class, 'Could not read file');
});

it('enables multiline mode by default', function () {
    $regex = new FluentRegex('foo bar baz');

    expect($regex->multiline)
        ->toBeBool()
        ->toBe(true);
});

it('can disable multiline mode', function () {
    $regex = (new FluentRegex('foo bar baz'))->disableMultilineFlag();

    expect($regex->multiline)
        ->toBeBool()
        ->toBe(false);

    $regex->multiline = true;

    $regex->setMultilineFlag(false);

    expect($regex->multiline)
        ->toBeBool()
        ->toBe(false);
});

it('can enable multiline mode', function () {
    $regex = (new FluentRegex('foo bar baz'))->disableMultilineFlag();
    $regex->enableMultilineFlag();
    expect($regex->multiline)
        ->toBeBool()
        ->toBe(true);

    $regex->multiline = false;

    $regex->setMultilineFlag(true);

    expect($regex->multiline)
        ->toBeBool()
        ->toBe(true);
});

it('enables unicode mode by default', function () {
    $regex = new FluentRegex('foo bar baz');

    expect($regex->unicode)
        ->toBeBool()
        ->toBe(true);
});

it('can disable unicode mode', function () {
    $regex = (new FluentRegex('foo bar baz'))->disableUnicodeFlag();

    expect($regex->unicode)
        ->toBeBool()
        ->toBe(false);

    $regex->unicode = true;

    $regex->setUnicodeFlag(false);

    expect($regex->unicode)
        ->toBeBool()
        ->toBe(false);
});

it('can enable unicode mode', function () {
    $regex = (new FluentRegex('foo bar baz'))->disableUnicodeFlag();
    $regex->enableUnicodeFlag();
    expect($regex->unicode)
        ->toBeBool()
        ->toBe(true);

    $regex->unicode = false;

    $regex->setUnicodeFlag(true);

    expect($regex->unicode)
        ->toBeBool()
        ->toBe(true);
});
