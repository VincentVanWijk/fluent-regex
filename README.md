# Fluent Regex

A powerful Laravel package that provides an elegant, fluent interface for building regular expressions in PHP. Say goodbye to cryptic regex syntax and hello to readable, maintainable pattern matching.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vincentvanwijk/fluent-regex.svg?style=flat-square)](https://packagist.org/packages/vincentvanwijk/fluent-regex)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/vincentvanwijk/fluent-regex/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/vincentvanwijk/fluent-regex/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/vincentvanwijk/fluent-regex/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/vincentvanwijk/fluent-regex/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![PHPStan](https://github.com/VincentVanWijk/fluent-regex/actions/workflows/phpstan.yml/badge.svg)](https://github.com/VincentVanWijk/fluent-regex/actions/workflows/phpstan.yml)
[![codecov](https://codecov.io/gh/VincentVanWijk/fluent-regex/branch/main/graph/badge.svg)](https://codecov.io/gh/VincentVanWijk/fluent-regex)
[![Total Downloads](https://img.shields.io/packagist/dt/vincentvanwijk/fluent-regex.svg?style=flat-square)](https://packagist.org/packages/vincentvanwijk/fluent-regex)

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Documentation](#documentation)
  - [Character Matching](#character-matching)
  - [Quantifiers](#quantifiers)
  - [Anchors & Boundaries](#anchors--boundaries)
  - [Groups & Captures](#groups--captures)
  - [Backreferences](#backreferences)
  - [Lookahead & Lookbehind](#lookahead--lookbehind)
  - [Character Classes](#character-classes)
  - [Special Characters & Tokens](#special-characters--tokens)
  - [Mode Modifiers](#mode-modifiers)
  - [Substitution & Replacement](#substitution--replacement)
- [Modifiers](#modifiers)
- [Configuration](#configuration)
- [Advanced Usage](#advanced-usage)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)

## Features

✨ **Readable Syntax** - Write regex patterns using intuitive, chainable methods
🔒 **Automatic Escaping** - Special characters are escaped automatically
🎯 **Type Safety** - Full IDE autocomplete support and type hints
🧪 **Thoroughly Tested** - Comprehensive test coverage
🎨 **Laravel Integration** - Seamless integration with Laravel applications
⚡ **Full Regex Support** - Complete implementation of PHP regex features including:
- Named and numbered capture groups with backreferences
- Lookahead and lookbehind assertions (positive and negative)
- Atomic groups and possessive quantifiers
- Conditional patterns and recursion
- POSIX character classes
- Mode modifiers (case-insensitive, multiline, etc.)
- Unicode and hexadecimal character support

## Requirements

- PHP 8.1 or higher
- Laravel 9.0 or higher

## Installation

Install the package via Composer:

```bash
composer require vincentvanwijk/fluent-regex
```

Optionally, publish the configuration file:

```bash
php artisan vendor:publish --tag="fluent-regex-config"
```

## Quick Start

```php
use VincentVanWijk\FluentRegex\Facades\FluentRegex;

// Create a regex to match an email address
$regex = FluentRegex::create('contact@example.com')
    ->alphaNumeric()->oneOrMoreTimes()
    ->exactly('@')
    ->letter()->oneOrMoreTimes()
    ->exactly('.')
    ->letter()->betweenNTimes(2, 4);

// Test the pattern
if ($regex->test()) {
    echo "Valid email!";
}

// Get the regex string
echo $regex->get(); // /[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]{2,4}/mu
```

## Documentation

### Character Matching

#### Basic Matching

```php
// Match exact strings (automatically escaped)
->exactly('hello')              // hello
->exactly('regex!')             // regex\!

// Match any single character
->anyCharacter()                // .

// Match specific character sets
->anyCharacterOf('abc')         // [abc]
->anyCharacterOf('0-9')         // [0\-9]

// Negated character sets (using not modifier)
->not->anyCharacterOf('abc')    // [^abc]
```

#### Letter & Number Matching

```php
->letter()                      // [a-zA-Z]
->lowerCaseLetter()             // [a-z]
->upperCaseLetter()             // [A-Z]
->digit()                       // \d (equivalent to [0-9])
->not->digit()                  // \D (non-digit)
->alphaNumeric()                // [a-zA-Z0-9]
->hexDigit()                    // [0-9A-Fa-f]
```

#### Character Ranges

```php
->range('a', 'z')               // [a-z]
->range('0', '9')               // [0-9]
->not->range('A', 'Z')          // [^A-Z]
```

### Quantifiers

Quantifiers specify how many times a pattern should match. All quantifiers support lazy and possessive modes.

```php
// Basic quantifiers
->zeroOrOneTime()               // ?
->zeroOrMoreTimes()             // *
->oneOrMoreTimes()              // +

// Specific counts
->nTimes(3)                     // {3}
->nTimesOrMore(3)               // {3,}
->betweenNTimes(3, 6)           // {3,6}

// Quantifiers with strings
->zeroOrOneTime('a')            // a?
->oneOrMoreTimes('x')           // x+
->nTimesOf('b', 5)              // b{5}

// Lazy quantifiers (match as few as possible)
->lazy->oneOrMoreTimes()        // +?
->lazy->zeroOrMoreTimes()       // *?

// Possessive quantifiers (no backtracking)
->possessive->oneOrMoreTimes()  // ++
->possessive->zeroOrMoreTimes() // *+
```

### Anchors & Boundaries

```php
// Line and string anchors
->startOfLine()                 // ^ (affected by multiline mode)
->endOfLine()                   // $ (affected by multiline mode)
->startOfString()               // \A (not affected by multiline)
->endOfString()                 // \Z (not affected by multiline)
->absoluteEndOfString()         // \z (strict end, no trailing newline)

// Word boundaries
->wordBoundary()                // \b
->nonWordBoundary()             // \B
```

### Groups & Captures

#### Capture Groups

```php
// Numbered capture group
->captureGroup(function ($regex) {
    return $regex->digit()->oneOrMoreTimes();
})  // (\d+)

// Named capture group
->namedCaptureGroup('year', function ($regex) {
    return $regex->digit()->nTimes(4);
})  // (?<year>\d{4})

// Non-capturing group
->nonCaptureGroup(function ($regex) {
    return $regex->exactly('http')->zeroOrOneTime('s');
})  // (?:https?)
```

#### Advanced Groups

```php
// Atomic group (prevents backtracking)
->atomicGroup(function ($regex) {
    return $regex->digit()->oneOrMoreTimes();
})  // (?>\d+)

// Conditional pattern
->conditional(1,
    function ($regex) { return $regex->exactly('yes'); },
    function ($regex) { return $regex->exactly('no'); }
)  // (?(1)yes|no)

// Recursion
->recurse()                     // (?R) - recurse entire pattern
->recurseGroup(1)               // (?1) - recurse group 1
```

### Backreferences

Reference previously captured content:

```php
// Match repeated words: "the the" or "is is"
FluentRegex::create('the the')
    ->captureGroup(fn($r) => $r->wordCharacter()->oneOrMoreTimes())
    ->whiteSpace()
    ->backreference(1);         // \1

// Using named backreferences
FluentRegex::create('hello hello')
    ->namedCaptureGroup('word', fn($r) => $r->letter()->oneOrMoreTimes())
    ->whiteSpace()
    ->namedBackreference('word');  // \k<word>
```

### Lookahead & Lookbehind

Assert patterns without consuming characters:

```php
// Positive lookahead - assert that pattern follows
->positiveLookAhead(function ($regex) {
    return $regex->digit();
})  // (?=\d)

// Negative lookahead - assert that pattern does NOT follow
->negativeLookAhead(function ($regex) {
    return $regex->whiteSpace();
})  // (?!\s)

// Positive lookbehind - assert that pattern precedes
->positiveLookBehind(function ($regex) {
    return $regex->exactly('$');
})  // (?<=\$)

// Negative lookbehind - assert that pattern does NOT precede
->negativeLookBehind(function ($regex) {
    return $regex->digit();
})  // (?<!\d)
```

### Character Classes

#### Meta Sequences

```php
->whiteSpace()                  // \s (space, tab, newline)
->nonWhiteSpace()               // \S
->wordCharacter()               // \w ([a-zA-Z0-9_])
->not->wordCharacter()          // \W
->uniCodeCharacter()            // \X (any Unicode sequence)
```

#### POSIX Character Classes

```php
->punctuation()                 // [[:punct:]]
->blank()                       // [[:blank:]] (space and tab only)
->controlCharacter()            // [[:cntrl:]]
->graphicCharacter()            // [[:graph:]] (visible characters)
->printableCharacter()          // [[:print:]] (visible + spaces)
```

### Special Characters & Tokens

```php
// Whitespace characters
->newLine()                     // \R (any newline sequence)
->lineFeed()                    // \n
->carriageReturn()              // \r
->tabCharacter()                // \t
->verticalTab()                 // \v
->formFeed()                    // \f

// Special characters
->nullCharacter()               // \0
->alarm()                       // \a (bell)
->escapeCharacter()             // \e

// Character by code
->hexCharacter('41')            // \x41 (matches 'A')
->unicodeCharacter('00A9')      // \u00A9 (matches ©)
->controlCharacter('C')         // \cC (Ctrl+C)

// Alternation
->or('cat', 'dog', 'bird')      // cat|dog|bird

// Comments (ignored by regex engine)
->comment('Match the domain')   // (?#Match the domain)

// Raw regex (for advanced users)
->raw('[a-z]{2,}')              // [a-z]{2,}
```

### Mode Modifiers

Change regex behavior inline:

```php
// Case sensitivity
->caseInsensitive()             // (?i)
->caseSensitive()               // (?-i)

// Dot behavior
->dotMatchesNewlines()          // (?s) - dot matches any character including newlines
->dotExcludesNewlines()         // (?-s)

// Multiline mode
->inlineMultilineMode()         // (?m)
->disableInlineMultilineMode()  // (?-m)

// Free-spacing mode (ignore whitespace, allow comments with #)
->freeSpacingMode()             // (?x)
->disableFreeSpacingMode()      // (?-x)

// Multiple modifiers at once
->setModeModifiers('im')        // (?im)
->setModeModifiers('i', 's')    // (?i-s)
```

### Substitution & Replacement

```php
$regex = FluentRegex::create('Hello World');

// Basic replacement
$result = $regex->digit()->replace('X');

// Replace with backreferences
$result = $regex->captureGroup(fn($r) => $r->wordCharacter()->oneOrMoreTimes())
    ->replace('[$1]');  // Wrap each word in brackets

// Replace with callback
$result = $regex->wordCharacter()->oneOrMoreTimes()
    ->replaceCallback(fn($matches) => strtoupper($matches[0]));

// Replace and get count
['result' => $text, 'count' => $n] = $regex->digit()->replaceWithCount('X');

// Split by pattern
$parts = $regex->whiteSpace()->oneOrMoreTimes()->split();

// Test if pattern matches
if ($regex->digit()->test()) {
    echo "Contains digits!";
}
```

## Modifiers

Modifiers temporarily change behavior for the next method call:

### The `not` Modifier

Negates character classes:

```php
->not->letter()                 // [^a-zA-Z]
->not->digit()                  // \D
->not->anyCharacterOf('aeiou')  // [^aeiou]
```

### The `lazy` Modifier

Makes quantifiers match as few characters as possible:

```php
->lazy->oneOrMoreTimes()        // +?
->lazy->zeroOrMoreTimes()       // *?
->lazy->betweenNTimes(2, 5)     // {2,5}?
```

### The `possessive` Modifier

Makes quantifiers possessive (no backtracking):

```php
->possessive->oneOrMoreTimes()  // ++
->possessive->zeroOrMoreTimes() // *+
```

**Note:** Modifiers automatically reset after each method call.

## Configuration

Configure default behavior in `config/fluent-regex.php`:

```php
return [
    // Delimiter used at the start and end of the regex
    'delimiter' => '/',

    // Multiline mode: ^ and $ match line boundaries (not just string boundaries)
    'multiLineMode' => true,

    // Unicode mode: pattern strings are treated as UTF-16
    'unicodeMode' => true,
];
```

You can override these per-instance:

```php
$regex = FluentRegex::create('test', '#')  // Custom delimiter
    ->disableMultilineFlag()
    ->disableUnicodeFlag();
```

## Advanced Usage

### Email Validation

```php
$email = FluentRegex::create('user@example.com')
    ->startOfString()
    ->alphaNumeric()->oneOrMoreTimes()
    ->anyCharacterOf('._-')->zeroOrMoreTimes()
    ->exactly('@')
    ->alphaNumeric()->oneOrMoreTimes()
    ->exactly('.')
    ->letter()->betweenNTimes(2, 4)
    ->endOfString();

if ($email->test()) {
    echo "Valid email!";
}
```

### URL Matching

```php
$url = FluentRegex::create($input)
    ->startOfString()
    ->exactly('http')
    ->exactly('s')->zeroOrOneTime()
    ->exactly('://')
    ->nonCaptureGroup(fn($r) =>
        $r->alphaNumeric()->oneOrMoreTimes()
            ->anyCharacterOf('.-')->zeroOrMoreTimes()
    )
    ->oneOrMoreTimes()
    ->endOfString();
```

### Phone Number Extraction

```php
$phone = FluentRegex::create($text)
    ->nonCaptureGroup(fn($r) => $r->digit()->nTimes(3))
    ->anyCharacterOf('-.')->zeroOrOneTime()
    ->digit()->nTimes(3)
    ->anyCharacterOf('-.')->zeroOrOneTime()
    ->digit()->nTimes(4);

$matches = $phone->matchAll();
```

### Password Validation with Lookaheads

```php
// At least 8 chars, one uppercase, one lowercase, one digit
$password = FluentRegex::create($input)
    ->startOfString()
    ->positiveLookAhead(fn($r) => $r->anyCharacter()->zeroOrMoreTimes()->upperCaseLetter())
    ->positiveLookAhead(fn($r) => $r->anyCharacter()->zeroOrMoreTimes()->lowerCaseLetter())
    ->positiveLookAhead(fn($r) => $r->anyCharacter()->zeroOrMoreTimes()->digit())
    ->anyCharacter()->nTimesOrMore(8)
    ->endOfString();
```

### Creating from File

```php
$regex = FluentRegex::createFromFile('/path/to/file.txt')
    ->exactly('search term')
    ->match();
```

## Testing

Run the test suite:

```bash
composer test
```

Run tests with coverage:

```bash
composer test-coverage
```

Run static analysis:

```bash
composer analyse
```

Fix code style:

```bash
composer format
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Security

If you discover any security-related issues, please email vincentvanwijk@hotmail.nl instead of using the issue tracker.

## Credits

- [Vincent van Wijk](https://github.com/VincentVanWijk)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
