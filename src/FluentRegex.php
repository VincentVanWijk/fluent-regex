<?php
declare(strict_types=1);

namespace VincentVanWijk\FluentRegex;

use VincentVanWijk\FluentRegex\Traits\CharacterClasses;
use VincentVanWijk\FluentRegex\Traits\GroupConstructs;

class FluentRegex
{
    use CharacterClasses;
    use GroupConstructs;

    private string $subject;

    private string $delimiter;

    private string $regex = '';

    public function __construct(string $subject, $delimiter = '/')
    {
        $this->subject = $subject;
        $this->delimiter = $delimiter;
    }

    public function match(): array
    {
        $matches = [];
        preg_match($this->get(), $this->subject, $matches);

        return $matches;
    }

    public function matchAll(): array
    {
        $matches = [];
        preg_match_all($this->get(), $this->subject, $matches);

        return $matches;
    }

    public function escape(string $string): string
    {
        return preg_quote($string, $this->delimiter);
    }

    public function get(bool $withoutDelimiters = false): string
    {

        return $withoutDelimiters ? $this->regex : $this->delimiter . $this->regex . $this->delimiter;
    }
}
