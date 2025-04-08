<?php

namespace Tests\Seworqs\Commons\String\Helper;

use PHPUnit\Framework\TestCase;
use Seworqs\Commons\String\Helper\PathHelper;
use Seworqs\Commons\String\Helper\CaseHelper;

class HelperPathHelperTest extends TestCase
{
    public function test_from_string_and_basic_path_output()
    {
        $helper = PathHelper::fromString('App/Http/Controllers');

        $this->assertEquals('App/Http/Controllers', $helper->toPath());
        $this->assertEquals('app/http/controllers', $helper->toKebabPath());
        $this->assertEquals('app_http_controllers', $helper->toSnakePath('_'));
        $this->assertEquals('app/http/controllers', $helper->toCamelPath());
    }

    public function test_from_array_and_segment_manipulation()
    {
        $helper = PathHelper::fromArray(['core', 'module'])
            ->appendSegment('service')
            ->prependSegment('src');

        $this->assertEquals('src/core/module/service', $helper->toPath());
    }

    public function test_from_case_helper()
    {
        $case = CaseHelper::from('my-app/controller-name');
        $path = PathHelper::fromCaseHelper($case);

        $this->assertEquals(['my', 'app', 'controller', 'name'], $path->getSegments());
        $this->assertEquals('my/app/controller/name', $path->toKebabPath());
    }

    public function test_unicode_safe_segments()
    {
        $helper = PathHelper::fromArray(['FööController', 'Äpi']);
        $this->assertEquals('föö-controller/äpi', $helper->toKebabPath());
    }

    public function test_empty_string_input()
    {
        $helper = PathHelper::fromString('');
        $this->assertEquals([], $helper->getSegments());
        $this->assertEquals('', $helper->toPath());
    }

    public function test_custom_separator_output()
    {
        $helper = PathHelper::fromString('Domain\\Shared\\Helpers');
        $this->assertEquals('domain.shared.helpers', $helper->toSnakePath('.'));
    }

    public function test_immutability()
    {
        $original = PathHelper::fromArray(['base']);
        $appended = $original->appendSegment('child');

        $this->assertEquals(['base'], $original->getSegments());
        $this->assertEquals(['base', 'child'], $appended->getSegments());
    }
}
