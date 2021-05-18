<?php

namespace Akhaled\Like4Card\Tests;

use Akhaled\Like4Card\Like4Card;
use Akhaled\Like4Card\Like4CardServiceProvider;
use Akhaled\Like4Card\Tests\Mock\Like4CardMock;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;

class TestCase extends BaseTestCase
{
    use InteractsWithContainer;

    public $like4Card;

    public function setUp(): void
    {
        parent::setUp();

        $this->like4Card = $this->fakeLike4Card();
    }

    protected function getPackageProviders($app)
    {
        return [
            Like4CardServiceProvider::class,
        ];
    }

    protected function fakeLike4Card()
    {
        return $this->swap(Like4Card::class, new Like4CardMock());
    }
}
