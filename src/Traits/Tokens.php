<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait Tokens
{
    /**
     * Matches any character other than newline
     */
    public function anyCharacter(): static
    {
        $this->addToRegex('.');

        return $this;
    }

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
}
