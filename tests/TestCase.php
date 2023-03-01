<?php

namespace VincentVanWijk\FluentRegex\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use VincentVanWijk\FluentRegex\FluentRegexServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn(string $modelName) => 'VincentVanWijk\\FluentRegex\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

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
