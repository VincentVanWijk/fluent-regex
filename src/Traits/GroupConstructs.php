<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

use VincentVanWijk\FluentRegex\FluentRegex;

trait GroupConstructs
{
    /**
     * Isolates part of the full match to be later referred to by ID within the regex or the matches array.
     * IDs start at 1.
     */
    public function captureGroup(callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new self());
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '('.$regexString.')';

        return $this;
    }

    /**
     * A non-capturing group allows you to apply quantifiers to part of your regex but does not capture/assign an ID.
     */
    public function nonCaptureGroup(callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new self());
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '(?:'.$regexString.')';

        return $this;
    }
}
