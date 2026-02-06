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

    /**
     * Creates a named capture group that can be referenced by name instead of number.
     *
     * @param  string  $name  The name for the capture group
     * @param  callable  $func  Callback function to build the pattern
     */
    public function namedCaptureGroup(string $name, callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new self());
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '(?<'.$name.'>'.$regexString.')';

        return $this;
    }

    /**
     * Creates an atomic group (possessive group) that prevents backtracking.
     * Once the group matches, the regex engine will not backtrack into it.
     *
     * @param  callable  $func  Callback function to build the pattern
     */
    public function atomicGroup(callable $func): static
    {
        /** @var FluentRegex $regex */
        $regex = call_user_func($func, new self());
        $regexString = $regex->get(withoutDelimiters: true);

        $this->regex .= '(?>'.$regexString.')';

        return $this;
    }

    /**
     * Creates a conditional pattern: if condition matches, use yes pattern, otherwise use no pattern.
     *
     * @param  int|string  $condition  Group number or name to check
     * @param  callable  $yes  Pattern to use if condition matches
     * @param  callable|null  $no  Optional pattern to use if condition doesn't match
     */
    public function conditional(int|string $condition, callable $yes, ?callable $no = null): static
    {
        /** @var FluentRegex $yesRegex */
        $yesRegex = call_user_func($yes, new self());
        $yesString = $yesRegex->get(withoutDelimiters: true);

        if ($no !== null) {
            /** @var FluentRegex $noRegex */
            $noRegex = call_user_func($no, new self());
            $noString = $noRegex->get(withoutDelimiters: true);
            $this->regex .= '(?('.$condition.')'.$yesString.'|'.$noString.')';
        } else {
            $this->regex .= '(?('.$condition.')'.$yesString.')';
        }

        return $this;
    }

    /**
     * Recurses the entire regex pattern at this point.
     * Useful for matching nested structures.
     */
    public function recurse(): static
    {
        $this->addToRegex('(?R)');

        return $this;
    }

    /**
     * Recurses a specific capture group by its number.
     * Useful for matching nested structures.
     *
     * @param  int  $groupNumber  The capture group number to recurse
     */
    public function recurseGroup(int $groupNumber): static
    {
        $this->addToRegex('(?'.$groupNumber.')');

        return $this;
    }
}
