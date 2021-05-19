<?php

namespace CodeBugLab\Like4Card\Tests;

use CodeBugLab\Like4Card\Services\Like4CardAPI;
use CodeBugLab\Like4Card\Like4CardServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use CodeBugLab\Like4Card\Tests\Mock\Like4CardAPIMock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;

class TestCase extends BaseTestCase
{
    use InteractsWithContainer, RefreshDatabase;

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
        return $this->swap(Like4CardAPI::class, new Like4CardAPIMock());
    }
}
