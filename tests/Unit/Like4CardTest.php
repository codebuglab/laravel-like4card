<?php

namespace Akhaled\Like4Card\Tests\Unit;

use Akhaled\Like4Card\Tests\TestCase;

class Like4CardTest extends TestCase
{
    public function test_can_get_balance()
    {
        $response = $this->like4Card::balance();
    }
}
