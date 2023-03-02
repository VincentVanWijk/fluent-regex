<?php

namespace VincentVanWijk\FluentRegex\Traits;

trait CharacterClasses
{
    public function exactly(string $exactly): static
    {
        $this->regex .= $this->escape($exactly);

        return $this;
    }

    public function singleCharacterOf(...$characters): static
    {
        $this->regex .= '[';

        foreach ($characters as $char) {
            $this->regex .= $this->escape($char);
        }

        $this->regex .= ']';

        return $this;
    }
}
