<?php

namespace Bdgt\Tests;

use Mockery;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use ReflectionMethod;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use DatabaseTransactions;

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
     * @param null $args
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

    /**
     * @param  \stdClass  $object
     * @param  string    $method
     * @param  array     $args
     * @return mixed
     */
    protected function runReflectedMethod($object, $method, $args = [])
    {
        if (is_string($object)) {
            $object = get_class($object);
        }

        $method = new ReflectionMethod($object, $method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $args);
    }
}
