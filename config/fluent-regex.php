<?php

declare(strict_types=1);

return [
    /**
     * The delimiter used at the start and end of the regex.
     */
    'delimiter' => '/',

    /**
     * Whether or not to use multiline mode.
     * If enabled, the ^ and $ tokens will match the start and end of a line, respectively.
     * If disabled, the ^ and $ tokens will match the start and end of the string, respectively.
     */
    'multiLineMode' => true,

    /**
     * Pattern strings are treated as UTF-16. Also causes escape sequences to match unicode characters.
     */
    'unicodeMode' => true,
];
