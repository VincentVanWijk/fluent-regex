<?php
declare(strict_types=1);

namespace VincentVanWijk\FluentRegex;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use VincentVanWijk\FluentRegex\Commands\FluentRegexCommand;

class FluentRegexServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('fluent-regex')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_fluent-regex_table')
            ->hasCommand(FluentRegexCommand::class);
    }
}
