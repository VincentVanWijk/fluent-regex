<?php

namespace VincentVanWijk\FluentRegex\Traits;

trait Token
{
    public function anyCharacter(): static
    {
        $this->addToRegex('.');

        return $this;
    }
}
