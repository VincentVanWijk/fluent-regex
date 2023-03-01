<?php

use VincentVanWijk\FluentRegex\FluentRegex;

it('returns a string', function () {
    $regex = new FluentRegex('foo bar baz');

    $regex->exactly('bar');
    $regexString = $regex->toRegexString();

    expect($regexString)->toBeString();
});
