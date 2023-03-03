<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

use VincentVanWijk\FluentRegex\FluentRegex;

trait GroupConstructs
{
    public function capture(callable $func): static
    {
        $regexString = call_user_func($func, new FluentRegex(''))
            ->get(withoutDelimiters: true);

        $this->regex .= '('.$regexString.')';

        return $this;
    }
}
