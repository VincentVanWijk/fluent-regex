<?php

namespace VincentVanWijk\FluentRegex;

class FluentRegex
{
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
        $this->regex = $this->delimiter . $this->regex . $this->delimiter;
        $matches = [];
        preg_match($this->regex, $this->subject, $matches);

        return $matches;
    }

    public function matchAll(): array
    {
        $this->regex = $this->delimiter . $this->regex . $this->delimiter;

        $matches = [];
        preg_match_all($this->regex, $this->subject, $matches);
        return $matches;
    }

    public function escape($string): string
    {
        return preg_quote($string, $this->delimiter);
    }

    public function exactly(string $exactly): static
    {
        $this->regex .= $this->escape($exactly);

        return $this;
    }

    public function characters(...$characters): static
    {
        $this->regex .= '[';

        foreach ($characters as $char) {
            $this->regex .= $this->escape($char);
        }

        $this->regex .= ']';

        return $this;
    }

    public function toRegexString(): string
    {
        return $this->regex;
    }
}
