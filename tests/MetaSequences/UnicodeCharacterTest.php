<?php

declare(strict_types=1);

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('returns the correct regex', function () {
    $regex = FluentRegex::create('äny únicød3 character')
        ->uniCodeCharacter()
        ->get();

    expect($regex)->toBeString()
        ->toBe('/\X/m');
});

//FIXME: Find out what is happening to these unicode characters
//it('returns the correct match', function () {
//    $regex = FluentRegex::create("äny únicød3 character")
//        ->uniCodeCharacter()
//        ->match();
//
//    expect($regex)->toBeArray()
//        ->toBe(['ä']);
//});
//
//it('returns the correct matches', function () {
//    $regex = FluentRegex::create("äny únicød3 character")
//        ->uniCodeCharacter()
//        ->matchAll();
//
//    expect($regex)->toBeString()
//        ->toBe([[]]);
//});
