<?php

use VincentVanWijk\FluentRegex\Facades\FluentRegex;

it('creates the username regex corectly', function () {
    $regex = FluentRegex::create('my-USER_n4m3')
        ->startOfLine()
        ->anyCharacterOf(function ($regex) {
            return $regex->alphanumeric()
                ->exactly('_-');
        })->betweenNTimes(3, 16)
        ->endOfLine();

    expect($regex->get())->toBe('/^[a-zA-Z0-9_\-]{3,16}$/mu')
        ->and($regex->match())->toBeArray()->toBe(['my-USER_n4m3']);
});

it('can create a regex that contains a least 1 digit, upper and lowercase letter and a special character',
    function () {
        $regex = FluentRegex::create('my-USER_n4m3')
            ->startOfLine()
            ->positiveLookAhead(function ($regex) {
                return $regex->anyCharacter()
                    ->zeroOrMoreTimes()
                    ->digit();
            })
            ->positiveLookAhead(function ($regex) {
                return $regex->anyCharacter()
                    ->zeroOrMoreTimes()
                    ->lowercaseLetter();
            })
            ->positiveLookAhead(function ($regex) {
                return $regex->anyCharacter()
                    ->zeroOrMoreTimes()
                    ->uppercaseLetter();
            })
            ->positiveLookAhead(function ($regex) {
                return $regex->anyCharacter()
                    ->zeroOrMoreTimes()
                    ->not->wordCharacter();
            })
            ->anyCharacter()
            ->betweenNTimes(8, 18)
            ->endOfLine();

        expect($regex->get())->toBe('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,18}$/mu');
    });
