<?php

namespace Seworqs\Commons\String\Tests;

use PHPUnit\Framework\TestCase;
use Seworqs\Commons\String\Helper\RandomHelper;
use InvalidArgumentException;

class HelperRandomHelperTest extends TestCase
{
    public function test_default_random_string_length_and_content()
    {
        $random = RandomHelper::createRandomString();

        $this->assertIsString($random);
        $this->assertEquals(10, strlen($random));
    }

    public function test_random_string_with_custom_length()
    {
        $lengths = [1, 5, 32, 100];

        foreach ($lengths as $length) {
            $random = RandomHelper::createRandomString($length);
            $this->assertEquals($length, strlen($random));
        }
    }

    public function test_random_string_with_custom_haystack()
    {
        $haystack = 'XYZ';
        $random = RandomHelper::createRandomString(20, $haystack);

        $this->assertMatchesRegularExpression('/^[XYZ]+$/', $random);
    }

    public function test_random_string_with_unambiguous_characters()
    {
        $cleanSet = 'abcdefghjkmnpqrstuvwxyz23456789';
        $random = RandomHelper::createRandomString(50, $cleanSet);

        $this->assertMatchesRegularExpression('/^[abcdefghjkmnpqrstuvwxyz23456789]+$/', $random);
    }

    public function test_empty_haystack_throws_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        RandomHelper::createRandomString(5, '');
    }

    public function test_multiple_random_calls_produce_different_results()
    {
        $a = RandomHelper::createRandomString(16);
        $b = RandomHelper::createRandomString(16);

        // Not guaranteed, but statistically unlikely to be equal
        $this->assertNotEquals($a, $b);
    }
}
