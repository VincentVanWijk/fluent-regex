<?php
declare(strict_types=1);

use VincentVanWijk\FluentRegex\FluentRegex;

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

it('returns a the correct delimiter', function () {
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
