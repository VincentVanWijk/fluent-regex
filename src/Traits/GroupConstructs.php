<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait GroupConstructs
{
    public function capture(callable $func): static
    {
        $regexString = call_user_func($func, $this)
            ->get(withoutDelimiters: true);

        $this->regex .= '('.$regexString.')';

        return $this;
    }
}
