<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex;

use Exception;
use VincentVanWijk\FluentRegex\Traits\Anchors;
use VincentVanWijk\FluentRegex\Traits\CharacterClasses;
use VincentVanWijk\FluentRegex\Traits\GroupConstructs;
use VincentVanWijk\FluentRegex\Traits\MetaSequences;
use VincentVanWijk\FluentRegex\Traits\Quantifiers;
use VincentVanWijk\FluentRegex\Traits\Tokens;

/**
 * @property FluentRegex $not
 * @property FluentRegex $lazy
 */
class FluentRegex
{
    use Anchors;
    use CharacterClasses;
    use GroupConstructs;
    use Quantifiers;
    use Tokens;
    use MetaSequences;

    public string $subject;

    private string $delimiter;

    private string $regex = '';

    protected bool $not = false;

    protected bool $lazy = false;

    public bool $multiline;

    public function __construct(string $subject = '', string $delimiter = '')
    {
        $this->subject = $subject;
        $this->multiline = (bool) config('fluent-regex.multilineMode', true);

        if ($delimiter == '') {
            /**@phpstan-ignore-next-line */
            $this->delimiter = config('fluent-regex.delimiter', '/');
        } else {
            $this->delimiter = $delimiter;
        }
    }

    /**
     * @throws Exception
     */
    public function __get(string $name): static
    {
        if ($name == 'not') {
            $this->not = true;

            return $this;
        }

        if ($name == 'lazy') {
            $this->lazy = true;

            return $this;
        }

        throw new Exception('Property $'.$name.' does not exist.');
    }

    /**
     * @throws Exception
     */
    public function __set(string $name, mixed $value): void
    {
        if ($name == 'not') {
            throw new Exception('Cannot set value of property $not.');
        }

        if ($name == 'lazy') {
            throw new Exception('Cannot set value of property $lazy.');
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
        if ($withoutDelimiters) {
            return $this->regex;
        }

        $regex = $this->delimiter.$this->regex.$this->delimiter;
        $regex .= $this->multiline ? 'm' : '';

        return $regex;
    }

    private function reset(): void
    {
        $this->not = false;
        $this->lazy = false;
    }

    protected function addToRegex(string $string): static
    {
        $this->regex .= $string;
        $this->reset();

        return $this;
    }

    public function raw(string $string): static
    {
        $this->addToRegex($string);

        return $this;
    }

    public function setMultiline(bool $multiline): static
    {
        $this->multiline = $multiline;

        return $this;
    }

    public function enableMultiline(): static
    {
        $this->multiline = true;

        return $this;
    }

    public function disableMultiline(): static
    {
        $this->multiline = false;

        return $this;
    }
}
