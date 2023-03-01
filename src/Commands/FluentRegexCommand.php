<?php

namespace VincentVanWijk\FluentRegex\Commands;

use Illuminate\Console\Command;

class FluentRegexCommand extends Command
{
    public $signature = 'fluent-regex';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
