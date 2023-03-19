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

    /**
     * Asserts that the given subpattern can be matched here, without consuming characters.
     */
    public function positiveLookAhead(callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new self());
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '(?='.$regexString.')';

        return $this;
    }

    /**
     * Starting at the current position in the expression, ensures that the given pattern will not match.
     * Does not consume characters.
     */
    public function negativeLookAhead(callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new self());
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '(?!'.$regexString.')';

        return $this;
    }

    /**
     * Ensures that the given pattern will match, ending at the current position in the expression.
     * The pattern must have a fixed width. Does not consume any characters.
     */
    public function positiveLookBehind(callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new self());
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '(?<='.$regexString.')';

        return $this;
    }

    /**
     * Ensures that the given pattern would not match and end at the current position in the expression.
     * The pattern must have a fixed width. Does not consume characters.
     */
    public function negativeLookBehind(callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new self());
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '(?<!'.$regexString.')';

        return $this;
    }
}
