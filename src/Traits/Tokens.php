<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait Tokens
{
    /*
     * Matches any character other than newline
     */
    public function anyCharacter(): static
    {
        $this->addToRegex('.');

        return $this;
    }

    /*
     * Matches the start of a string without consuming any characters.
     * If multiline mode is used, this will also match immediately after a newline character.
     */
    public function startOfLine(): static
    {
        $this->addToRegex('^');

        return $this;
    }

    /*
     * Matches the end of a string without consuming any characters.
     * If  multiline mode is used, this will also match immediately before a newline character.
     */
    public function endOfLine(): static
    {
        $this->addToRegex('$');

        return $this;
    }

    /*
     * Matches the start of a string only. Unlike startOfLine(), this is not affected by multiline mode.
     */
    public function startOfString(): static
    {
        $this->addToRegex('\A');

        return $this;
    }

    /*
     * Matches the end of a string only. Unlike endOfLine(), this is not affected by multiline mode.
     */
    public function endOfString(): static
    {
        $this->addToRegex('\Z');

        return $this;
    }

    /*
     * Matches, without consuming any characters,
     * immediately between a character matched by \w and a character not matched by \w (in either order).
     * It cannot be used to separate non words from words.
     */
    public function wordBoundary(): static
    {
        $this->addToRegex('\b');

        return $this;
    }

    /*
     * Matches, without consuming any characters, at the position between two characters matched by \w or \W.
     */
    public function nonWordBoundary(): static
    {
        $this->addToRegex('\B');

        return $this;
    }

    /*
    * Matches any Unicode newline sequence. Equivalent to (?>\r\n|\n|\x0b|\f|\r|\x85)
    */
    public function newLine(): static
    {
        $this->addToRegex('\R');

        return $this;
    }

    /*
    * Matches a tab character. Historically, tab stops happen every 8 characters.
    */
    public function tab(): static
    {
        $this->addToRegex('\t');

        return $this;
    }

    /*
     * Matches a null character, most often visually represented in unicode using U+2400.
     */
    public function null(): static
    {
        $this->addToRegex('\0');

        return $this;
    }
}
