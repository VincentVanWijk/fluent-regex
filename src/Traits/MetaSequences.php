<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait MetaSequences
{
    public function whiteSpace(): static
    {
        $this->addToRegex('\s');

        return $this;
    }
}
