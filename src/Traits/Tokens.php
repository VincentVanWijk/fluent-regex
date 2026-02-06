<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait Tokens
{
    /**
     * Matches any Unicode newline sequence. Equivalent to (?>\r\n|\n|\x0b|\f|\r|\x85)
     */
    public function newLine(): static
    {
        $this->addToRegex('\R');

        return $this;
    }

    /**
     * Matches a tab character. Historically, tab stops happen every 8 characters.
     */
    public function tabCharacter(): static
    {
        $this->addToRegex('\t');

        return $this;
    }

    /**
     * Matches a null character, most often visually represented in unicode using U+2400.
     */
    public function nullCharacter(): static
    {
        $this->addToRegex('\0');

        return $this;
    }

    /**
     * Matches a carriage return character.
     */
    public function carriageReturn(): static
    {
        $this->addToRegex('\r');

        return $this;
    }

    /**
     * Matches a line feed character.
     */
    public function lineFeed(): static
    {
        $this->addToRegex('\n');

        return $this;
    }

    /**
     * Matches a form feed character.
     */
    public function formFeed(): static
    {
        $this->addToRegex('\f');

        return $this;
    }

    /**
     * Matches a vertical tab character.
     */
    public function verticalTab(): static
    {
        $this->addToRegex('\v');

        return $this;
    }

    /**
     * Matches an alarm (bell) character.
     */
    public function alarm(): static
    {
        $this->addToRegex('\a');

        return $this;
    }

    /**
     * Matches an escape character.
     */
    public function escapeCharacter(): static
    {
        $this->addToRegex('\e');

        return $this;
    }

    /**
     * Matches a character by its hexadecimal code.
     *
     * @param  string  $hex  Two-digit hexadecimal code (e.g., '41' for 'A')
     */
    public function hexCharacter(string $hex): static
    {
        $this->addToRegex('\x'.$hex);

        return $this;
    }

    /**
     * Matches a Unicode character by its code point.
     *
     * @param  string  $codePoint  Four-digit hexadecimal Unicode code point (e.g., '0041' for 'A')
     */
    public function unicodeCharacter(string $codePoint): static
    {
        $this->addToRegex('\u'.$codePoint);

        return $this;
    }

    /**
     * Matches a control character.
     *
     * @param  string  $char  Single character (e.g., 'A' for Ctrl+A)
     */
    public function controlCharacter(string $char): static
    {
        $this->addToRegex('\c'.$char);

        return $this;
    }

    /**
     * Adds an inline comment to the regex pattern.
     * Comments are ignored by the regex engine.
     *
     * @param  string  $comment  The comment text
     */
    public function comment(string $comment): static
    {
        $this->addToRegex('(?#'.$comment.')');

        return $this;
    }
}
