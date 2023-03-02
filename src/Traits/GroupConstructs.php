<?php

namespace VincentVanWijk\FluentRegex\Traits;

trait GroupConstructs
{
    public function capture(callable $func)
    {
        $regexString = call_user_func($func, $this)
            ->get(withoutDelimiters: true);

        $this->regex .= '('.$regexString.')';

        return $this;
    }
}
