<style>pre{margin-bottom: -16px; padding-bottom: 3px;padding-top: 0}</style>

# A package to fluently create regular expressions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vincentvanwijk/fluent-regex.svg?style=flat-square)](https://packagist.org/packages/vincentvanwijk/fluent-regex)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/vincentvanwijk/fluent-regex/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/vincentvanwijk/fluent-regex/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/vincentvanwijk/fluent-regex/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/vincentvanwijk/fluent-regex/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![PHPStan](https://github.com/VincentVanWijk/fluent-regex/actions/workflows/phpstan.yml/badge.svg)](https://github.com/VincentVanWijk/fluent-regex/actions/workflows/phpstan.yml)
[![codecov](https://codecov.io/gh/VincentVanWijk/fluent-regex/branch/main/graph/badge.svg)](https://codecov.io/gh/VincentVanWijk/fluent-regex)
[![Total Downloads](https://img.shields.io/packagist/dt/vincentvanwijk/fluent-regex.svg?style=flat-square)](https://packagist.org/packages/vincentvanwijk/fluent-regex)

## Installation

You can install the package via composer:

```bash
composer require vincentvanwijk/fluent-regex
```

## Usage

Start by callingthe create function on the FluentRegex class.

It takes the string that the regex is to be performed on as a parameter.

The second parameter is the delimiter, which defaults to `'/'`.

```php
use VincentVanWijk\FluentRegex\Facades\FluentRegex;

$fluentRegex = FluentRegex::create("foo bar baz");
```

---
You can add tokens to the regex by chaining methods on the FluentRegex object.

```phpregexp
/foo\s[bar baz]+/
```

```php
$fluentRegex->exactly("foo")
    ->whiteSpace()
    ->anyCharacterOf('bar baz')
    ->oneOrMoreTimes();
```

---
Characters that need it will be escaped automatically.

```phpregexp
/regex\!/
```

```php
$fluentRegex->exactly("regex!")
```

---
Most methods can be negated using the `not` modifier.

```phpregexp
/[a-zA-Z]/
```

```php
$fluentRegex->letter();
```

```phpregexp
/[^a-zA-Z]/
```

```php
$fluentRegex->not->letter();
```

## Grouping

Grouping constructs such as capturing groups take an anonymous function as a parameter.  
The anonymous function takes a FluentRegex object as a parameter.  
On this object you can continue to chain methods to create the sub-pattern for the capture group.

```phpregexp
/foo (bar baz)/
```

```php
$fluentRegex->exactly("foo ")      
    ->capture(function (FluentRegex $regex) {
         return $regex->exactly('bar') 
         ->whiteSpace()
         ->exactly('baz')       
    })
    ->exactly(' baz');                             
```

## Returning results

You can call the `match()` method to return an array with the matches.  
The first index `[0]` contains the text that matched the full pattern,
The second index `[1]` will contain the text that matched the first subpattern, and so on.

```php
$fluentRegex->match();
```

---
Or call the `matchAll()` method to return a multidimensional array with all matches.
The first index `[0]` is an array of full pattern matches
The second index `[1]` is an array of strings matched by the first subpattern, and so on.

```php
$fluentRegex->matchAll();
```

---
To get the regex in its string representation, call

```php
$fluentRegex->get();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Vincent van Wijk](https://github.com/VincentVanWijk)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
