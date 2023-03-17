<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

use Exception;
use VincentVanWijk\FluentRegex\FluentRegex;

trait CharacterClasses
{
    /**
     * @return $this
     */
    public function exactly(string $exactly): static
    {
        $this->addToRegex($this->escape($exactly));

        return $this;
    }

    public function anyCharacterOf(string|callable $characters): static
    {
        $this->addToRegex($this->not ? '[^' : '[');

        if (is_callable($characters)) {
            /** @var FluentRegex $regex */
            $regex = call_user_func($characters, new self());

            /**
             * remove any charactergroups from the regex that the user might have added
             * but keep escaped ones
             */
            $this->addToRegex(preg_replace('/(?<!\\\\)[\[\]]/', '', $regex->get(withoutDelimiters: true)) ?? '');
        } else {
            $this->addToRegex($this->escape($characters));
        }

        $this->addToRegex(']');

        return $this;
    }

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

    public function letter(): static
    {
        $this->addToRegex($this->not ? '[^a-zA-Z]' : '[a-zA-Z]');

        return $this;
    }

    public function lowerCaseLetter(): static
    {
        $this->addToRegex($this->not ? '[^a-z]' : '[a-z]');

        return $this;
    }

    public function upperCaseLetter(): static
    {
        $this->addToRegex($this->not ? '[^A-Z]' : '[A-Z]');

        return $this;
    }

    public function digit(): static
    {
        $this->addToRegex($this->not ? '[^0-9]' : '[0-9]');

        return $this;
    }

    public function alphaNumeric(): static
    {
        $this->addToRegex($this->not ? '[^a-zA-Z0-9]' : '[a-zA-Z0-9]');

        return $this;
    }

    /**
     * @throws Exception
     */
    public function range(string $from, string $to): static
    {
        $ascii1 = ord($from);
        $ascii2 = ord($to);

        if ($ascii1 > $ascii2) {
            throw new Exception('Character range is out of ASCII order.');
        }

        $this->addToRegex($this->not ? '[^' : '[');
        $this->addToRegex($from.'-'.$to);
        $this->addToRegex(']');

        return $this;
    }
}
