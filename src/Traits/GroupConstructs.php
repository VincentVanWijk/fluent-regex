<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

use VincentVanWijk\FluentRegex\FluentRegex;

trait GroupConstructs
{
    public function capture(callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new FluentRegex(''));
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '('.$regexString.')';

        return $this;
    }
}
