<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

use VincentVanWijk\FluentRegex\FluentRegex;

trait GroupConstructs
{
    public function captureGroup(callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new self());
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '('.$regexString.')';

        return $this;
    }

    public function nonCaptureGroup(callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new self());
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '(?:'.$regexString.')';

        return $this;
    }
}
