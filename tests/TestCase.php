<?php

namespace Bdgt\Tests;

use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * @param string $class
     * @param null $args
     * @return mixed
     */
    public function mock(string $class, $args = null)
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
