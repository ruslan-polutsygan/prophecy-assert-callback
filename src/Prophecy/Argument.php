<?php

namespace RP\Prophecy;

use RP\Prophecy\Argument\Token;

class Argument
{
    public static function assertThat($callback)
    {
        return new Token\AssertCallbackToken($callback);
    }
}
