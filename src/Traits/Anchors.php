<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait Anchors
{
    /**
     * Matches the start of a string without consuming any characters.
     * If multiline mode is used, this will also match immediately after a newline character.
     */
    public function startOfLine(): static
    {
        $this->addToRegex('^');

        return $this;
    }

    /**
     * Matches the end of a string without consuming any characters.
     * If  multiline mode is used, this will also match immediately before a newline character.
     */
    public function endOfLine(): static
    {
        $this->addToRegex('$');

        return $this;
    }

    /**
     * Matches the start of a string only. Unlike ^or startOfLine(), this is not affected by multiline mode.
     */
    public function startOfString(): static
    {
        $this->addToRegex('\A');

        return $this;
    }

    /**
     * Matches the end of a string only. Unlike $ or endOfLine(), this is not affected by multiline mode.
     */
    public function endOfString(): static
    {
        $this->addToRegex('\Z');

        return $this;
    }

    /**
     * Matches the end of a string only. Unlike $ or endOfLine(), this is not affected by multiline mode, and, in contrast to \Z,
     * will not match before a trailing newline at the end of a string.
     */
    public function absoluteEndOfString(): static
    {
        $this->addToRegex('\z');

        return $this;
    }

    /**
     * Matches, without consuming any characters,
     * immediately between a character matched by \w and a character not matched by \w (in either order).
     * It cannot be used to separate non words from words.
     */
    public function wordBoundary(): static
    {
        $this->addToRegex('\b');

        return $this;
    }

    /**
     * Matches, without consuming any characters, at the position between two characters matched by \w or \W.
     */
    public function nonWordBoundary(): static
    {
        $this->addToRegex('\B');

        return $this;
    }
}
