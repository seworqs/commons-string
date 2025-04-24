<?php

namespace Seworqs\Commons\String\Helper;

class RandomHelper
{

    ////////////////////
    // PUBLIC METHODS
    ////////////////////

    public static function createRandomString(int $length = 10, string $haystack = 'aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ01234567890'): string
    {
        $randomString = '';
        $charactersLength = strlen($haystack);

        if ($charactersLength === 0) {
            throw new \InvalidArgumentException('We need some characters to create a random string.');
        }

        // Shuffle the haystack 1-10 times to get "more randomness".
        for ($ix = 1; $ix <= random_int(1,10); $ix++) {
            $haystack = str_shuffle($haystack);
        }

        // Build random string.
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $haystack[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
