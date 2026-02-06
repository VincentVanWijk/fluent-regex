<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait Backreferences
{
    /**
     * Matches the same text as previously matched by a numbered capture group.
     *
     * @param  int  $groupNumber  The capture group number to reference (starting from 1)
     */
    public function backreference(int $groupNumber): static
    {
        $this->addToRegex('\\'.$groupNumber);

        return $this;
    }

    /**
     * Matches the same text as previously matched by a named capture group.
     *
     * @param  string  $groupName  The name of the capture group to reference
     */
    public function namedBackreference(string $groupName): static
    {
        $this->addToRegex('\k<'.$groupName.'>');

        return $this;
    }
}
