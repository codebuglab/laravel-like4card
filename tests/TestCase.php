<?php

namespace Akhaled\Like4Card\Tests;

use Akhaled\Like4Card\Like4CardServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            Like4CardServiceProvider::class,
        ];
    }
}
