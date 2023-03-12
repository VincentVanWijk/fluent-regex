<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait Quantifiers
{
    public function zeroOrOne(string $string = ''): static
    {
        $string = $this->escape($string);
        $this->addToRegex($string.'?');

        return $this;
    }

    public function zeroOrMore(string $string = ''): static
    {
        $string = $this->escape($string);
        $this->addToRegex($string.'*'.($this->lazy ? '?' : ''));

        return $this;
    }

    public function oneOrMore(string $string = ''): static
    {
        $string = $this->escape($string);
        $this->addToRegex($string.'+'.($this->lazy ? '?' : ''));

        return $this;
    }

    public function nTimes(int $times): static
    {
        $this->addToRegex('{'.$times.'}');

        return $this;
    }

    public function nTimesOf(string $string, int $times): static
    {
        $string = $this->escape($string);
        $this->addToRegex($string.'{'.$times.'}');

        return $this;
    }

    public function nTimesOrMore(int $times): static
    {
        $this->addToRegex('{'.$times.',}');

        return $this;
    }

    public function betweenNTimes(int $from, int $to): static
    {
        $this->addToRegex('{'.$from.','.$to.'}');

        return $this;
    }
}
