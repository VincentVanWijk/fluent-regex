<?php

namespace VincentVanWijk\FluentRegex\Traits;

trait Tokens
{
    public function anyCharacter(): static
    {
        $this->addToRegex('.');

        return $this;
    }
}
