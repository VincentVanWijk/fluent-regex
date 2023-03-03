<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex;

use Exception;
use VincentVanWijk\FluentRegex\Traits\CharacterClasses;
use VincentVanWijk\FluentRegex\Traits\GroupConstructs;

/**
 * @property FluentRegex $not
 */
class FluentRegex
{
    use CharacterClasses;
    use GroupConstructs;

    private string $subject;

    private string $delimiter;

    private string $regex = '';

    protected bool $not = false;

    public function __construct(string $subject = '', string $delimiter = '/')
    {
        $this->subject = $subject;
        $this->delimiter = $delimiter;
    }

    public function __get(string $name): static
    {
        if ($name == 'not') {
            $this->not = true;

            return $this;
        }

        return $this;
    }

    /**
     * @throws Exception
     */
    public function __set(string $name, mixed $value): void
    {
        if ($name == 'not') {
            throw new Exception('Cannot set value of property $not.');
        }
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

    protected function escape(string $string): string
    {
        return preg_quote($string, $this->delimiter);
    }

    public function get(bool $withoutDelimiters = false): string
    {
        return $withoutDelimiters ? $this->regex : $this->delimiter.$this->regex.$this->delimiter;
    }

    private function resetNot(): void
    {
        $this->not = false;
    }

    protected function addToRegex(string $string): static
    {
        $this->regex .= $string;
        $this->resetNot();

        return $this;
    }
}
