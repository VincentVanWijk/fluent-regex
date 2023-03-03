# A package to fluently create regular expressions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vincentvanwijk/fluent-regex.svg?style=flat-square)](https://packagist.org/packages/vincentvanwijk/fluent-regex)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/vincentvanwijk/fluent-regex/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/vincentvanwijk/fluent-regex/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/vincentvanwijk/fluent-regex/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/vincentvanwijk/fluent-regex/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/vincentvanwijk/fluent-regex.svg?style=flat-square)](https://packagist.org/packages/vincentvanwijk/fluent-regex)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/fluent-regex.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/fluent-regex)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can
support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.
You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards
on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require vincentvanwijk/fluent-regex
```

You can publish the config file with:

[//]: # (```bash)

[//]: # (php artisan vendor:publish --tag="fluent-regex-config")

[//]: # (```)

[//]: # ()

[//]: # (This is the contents of the published config file:)

[//]: # ()

[//]: # (```php)

[//]: # (return [)

[//]: # (];)

[//]: # (```)

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="fluent-regex-views"
```

## Usage

Start by creating a new instance of the FluentRegex class.

The first parameter is the string that the regex is performed on.

The second parameter is the delimiter, which defaults to `'/' `

```php
use  VincentVanWijk\FluentRegex\FluentRegex;
$fluentRegex = new FluentRegex("Let's do some regex!");
```

You can add tokens to the regex by chaining methods on the FluentRegex object.

```php
// '/Let's [abcd][mnop]/'
$fluentRegex->exactly("Let's ")
    ->anyCharacterOf('abcd')
    ->anyCharacterOf('mnop') 
```

Character that need it will be escaped automatically.

```php
// '/regex\!/'
$fluentRegex->exactly("regex!")
```

Most methods can be negated usig the `not` modifier.

```php
// '/[a-zA-Z]/'
$fluentRegex->letter();
// '/[^a-zA-Z]/'
$fluentRegex->not->letter();
```

## Grouping

Grouping construct such as capturing groups take an anonymous function as a parameter.  
The anonymous function takes a FluentRegex object as a parameter.  
On this object you can continue to chain methods to create the sub-pattern for the capture group.

```php
// '/Let's ([abcd][mnop]) some regex\!/'
$fluentRegex->exactly("Let's ")      
    ->capture(function (FluentRegex $regex) {
             return $regex->anyCharacterOf('abcd') 
             ->anyCharacterOf('mnop')       
        })
        ->exactly(' some regex!');                                   
```

## Returning results

You can call the `match()` method to return an array with the matches.  
The first index [0] contains the text that matched the full pattern,
The second index [1] will contain the text that matched the first subpattern, and so on.

```php
$fluentRegex->match();
```

Or call the `matchAll()` method to return an multidimensional array with all matches.
The first index [0] is an array of full pattern matches
The second index [1] is an array of strings matched by the first subpattern, and so on.

```php
$fluentRegex->matchAll();
```

To get the regex in it's string representation, call

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
