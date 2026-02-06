<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait ModeModifiers
{
    /**
     * Enables case-insensitive matching from this point forward.
     * Equivalent to (?i)
     */
    public function caseInsensitive(): static
    {
        $this->addToRegex('(?i)');

        return $this;
    }

    /**
     * Disables case-insensitive matching (makes matching case-sensitive).
     * Equivalent to (?-i)
     */
    public function caseSensitive(): static
    {
        $this->addToRegex('(?-i)');

        return $this;
    }

    /**
     * Enables single-line/dotall mode where . matches newlines.
     * Equivalent to (?s)
     */
    public function dotMatchesNewlines(): static
    {
        $this->addToRegex('(?s)');

        return $this;
    }

    /**
     * Disables single-line/dotall mode where . does not match newlines.
     * Equivalent to (?-s)
     */
    public function dotExcludesNewlines(): static
    {
        $this->addToRegex('(?-s)');

        return $this;
    }

    /**
     * Enables free-spacing mode (verbose mode) where whitespace is ignored and # starts a comment.
     * Equivalent to (?x)
     */
    public function freeSpacingMode(): static
    {
        $this->addToRegex('(?x)');

        return $this;
    }

    /**
     * Disables free-spacing mode (verbose mode).
     * Equivalent to (?-x)
     */
    public function disableFreeSpacingMode(): static
    {
        $this->addToRegex('(?-x)');

        return $this;
    }

    /**
     * Enables multiline mode where ^ and $ match line boundaries.
     * Equivalent to (?m)
     */
    public function inlineMultilineMode(): static
    {
        $this->addToRegex('(?m)');

        return $this;
    }

    /**
     * Disables multiline mode where ^ and $ match string boundaries only.
     * Equivalent to (?-m)
     */
    public function disableInlineMultilineMode(): static
    {
        $this->addToRegex('(?-m)');

        return $this;
    }

    /**
     * Sets multiple mode modifiers at once.
     *
     * @param  string  $modifiers  Modifiers to enable (e.g., 'im' for case-insensitive and multiline)
     * @param  string  $disable  Modifiers to disable (e.g., 's' to disable dotall)
     */
    public function setModeModifiers(string $modifiers, string $disable = ''): static
    {
        if ($disable !== '') {
            $this->addToRegex('(?'.$modifiers.'-'.$disable.')');
        } else {
            $this->addToRegex('(?'.$modifiers.')');
        }

        return $this;
    }
}
