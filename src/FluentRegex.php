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

    public function exactly(string $exactly)
    {
        $this->regex .= $exactly;
    }

    public function match(){
        $this->regex = $this->delimiter . $this->regex . $this->delimiter;

        return preg_match($this->regex, $this->subject);
    }
}
