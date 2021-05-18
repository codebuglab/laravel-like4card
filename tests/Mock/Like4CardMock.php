<?php

namespace Akhaled\Like4Card\Tests\Mock;

use Akhaled\Like4Card\Like4CardInterface;

class Like4CardMock implements Like4CardInterface
{
    public static function test()
    {
        return 'working!!';
    }

    public static function balance()
    {
        # code...
    }
}
