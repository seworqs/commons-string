<?php

namespace Seworqs\Commons\String\Helper;

class RandomHelper
{

    ////////////////////
    // PUBLIC METHODS
    ////////////////////

    public static function createRandomString(int $length = 10, string $heystack = 'aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ01234567890'): string
    {
        $randomString = '';
        $charactersLength = strlen($heystack);

        if ($charactersLength === 0) {
            throw new \InvalidArgumentException('We need some characters to create a random string.');
        }

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $heystack[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
