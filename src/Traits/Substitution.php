<?php

declare(strict_types=1);

namespace VincentVanWijk\FluentRegex\Traits;

trait Substitution
{
    /**
     * Performs a regex replacement on the subject string.
     *
     * @param  string  $replacement  The replacement string (can include $1, $2, etc. for backreferences)
     * @param  int  $limit  Maximum number of replacements (-1 for unlimited)
     * @return string The result of the replacement
     */
    public function replace(string $replacement, int $limit = -1): string
    {
        return preg_replace($this->get(), $replacement, $this->subject, $limit) ?? $this->subject;
    }

    /**
     * Performs a regex replacement using a callback function.
     *
     * @param  callable  $callback  Callback function that receives matches array and returns replacement
     * @param  int  $limit  Maximum number of replacements (-1 for unlimited)
     * @return string The result of the replacement
     */
    public function replaceCallback(callable $callback, int $limit = -1): string
    {
        return preg_replace_callback($this->get(), $callback, $this->subject, $limit) ?? $this->subject;
    }

    /**
     * Performs a regex replacement and returns the count of replacements made.
     *
     * @param  string  $replacement  The replacement string
     * @param  int  $limit  Maximum number of replacements (-1 for unlimited)
     * @return array{result: string, count: int} Array with 'result' and 'count' keys
     */
    public function replaceWithCount(string $replacement, int $limit = -1): array
    {
        $count = 0;
        $result = preg_replace($this->get(), $replacement, $this->subject, $limit, $count) ?? $this->subject;

        return ['result' => $result, 'count' => $count];
    }

    /**
     * Splits the subject string by the regex pattern.
     *
     * @param  int  $limit  Maximum number of splits (-1 for unlimited)
     * @param  int  $flags  PREG_SPLIT_* flags
     * @return array The split string parts
     */
    public function split(int $limit = -1, int $flags = 0): array
    {
        return preg_split($this->get(), $this->subject, $limit, $flags) ?: [];
    }

    /**
     * Checks if the pattern matches the subject.
     *
     * @return bool True if the pattern matches, false otherwise
     */
    public function test(): bool
    {
        return preg_match($this->get(), $this->subject) === 1;
    }
}
