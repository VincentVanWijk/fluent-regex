<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('foo bar baz');

    $regexString = $regex->range('0', 'b')
        ->get();

    expect($regexString)->toBeString()
        ->toBe('/[0-b]/m');
});

it('returns the correct match', function () {
    $regex = FluentRegex::create('foo bar baz');

    $match = $regex->range('0', 'b')
        ->match();

    expect($match)->toBeArray()
        ->toBe(['b']);
});

it('throws an exception when range is out of ASCII order', function () {
    expect(function () {
        $regex = FluentRegex::create('foo bar baz');
        $regex->range('b', 'a')
            ->match();
    })->toThrow(Exception::class, 'Character range is out of ASCII order.');
});

it('returns the correct matches', function () {
    $regex = FluentRegex::create('foo bar baz');

    $matches = $regex->range('0', 'b')
        ->matchAll();

    expect($matches)->toBeArray()
        ->toBe([['b', 'a', 'b', 'a']]);
});
