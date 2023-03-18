<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait MetaSequences
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
     * @param  string|array  $tokens
     * Matches either what is before the | or what is after it.
     */
    public function or(string|array ...$tokens): static
    {
        $or = '';

        foreach ($tokens as $key => $token) {
            /** @var string $token */
            $or .= $this->escape($token);

            if ($key !== array_key_last($tokens)) {
                $or .= '|';
            }
        }

        $this->addToRegex($or);

        return $this;
    }

    /**
     * Matches any space, tab or newline character.
     */
    public function whiteSpace(): static
    {
        $this->addToRegex('\s');

        return $this;
    }

    /**
     * Matches anything other than a space, tab or newline
     */
    public function nonWhiteSpace(): static
    {
        $this->addToRegex('\S');

        return $this;
    }

    /**
     * Matches any decimal digit. Equivalent to [0-9].
     */
    public function digit(): static
    {
        $this->addToRegex($this->not ? '\D' : '\d');

        return $this;
    }

    /**
     * Matches any letter, digit or underscore. Equivalent to [a-zA-Z0-9_].
     */
    public function wordCharacter(): static
    {
        $this->addToRegex($this->not ? '\W' : '\w');

        return $this;
    }

    /**
     * Matches any valid Unicode sequence, including line breaks. Equivalent to (?s:.).
     */
    public function uniCodeCharacter(): static
    {
        $this->addToRegex('\X');

        return $this;
    }
}
