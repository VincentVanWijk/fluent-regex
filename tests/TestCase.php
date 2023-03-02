<?php

namespace VincentVanWijk\FluentRegex\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use VincentVanWijk\FluentRegex\FluentRegexServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            FluentRegexServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
//        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_fluent-regex_table.php.stub';
        $migration->up();
        */
    }
}
