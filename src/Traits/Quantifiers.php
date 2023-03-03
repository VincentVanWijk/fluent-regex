<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

use VincentVanWijk\FluentRegex\FluentRegex;

trait Quantifiers
{
    public function zeroOrOne(string $string = ''): static
    {
        $this->addToRegex($string . '?');

        return $this;
    }

    public function zeroOrMore(string $string = ''): static
    {
        $this->addToRegex($string . '*');

        return $this;
    }

    public function oneOrMore(string $string = ''): static
    {
        $this->addToRegex($string . '+');

        return $this;
    }

    public function nTimes(int $times): static
    {
        $this->addToRegex('{' . $times . '}');

        return $this;
    }

    public function nTimesOf(string $string, int $times): static
    {
        $this->addToRegex($string . '{' . $times . '}');

        return $this;
    }
}
