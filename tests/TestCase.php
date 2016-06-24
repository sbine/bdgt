<?php

namespace Bdgt\Tests;

use Mockery;
use Illuminate\Contracts\Console\Kernel;

class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('DB_DEFAULT=sqlite_testing');

        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * @param string $class
     *
     * @return mixed
     */
    public function mock($class, $args = null)
    {
        if ($args) {
            $mock = Mockery::mock($class, $args);
        } else {
            $mock = Mockery::mock($class);
        }

        $this->app->instance($class, $mock);

        return $mock;
    }
}
