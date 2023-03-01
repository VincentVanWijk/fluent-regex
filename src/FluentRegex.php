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

    public function exactly(string $exactly):FluentRegex
    {
        $this->regex .= $exactly;

        return $this;
    }

    public function match():array
    {
        $this->regex = $this->delimiter . $this->regex . $this->delimiter;
        $matches = [];
        preg_match($this->regex, $this->subject, $matches);
        return $matches;
    }
}
