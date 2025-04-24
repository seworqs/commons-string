<?php

namespace Seworqs\Commons\String\Tests;

use PHPUnit\Framework\TestCase;
use Seworqs\Commons\String\Helper\NamespaceHelper;
use Seworqs\Commons\String\Helper\CaseHelper;

class HelperNamespaceHelperTest extends TestCase
{
    public function test_from_array_and_basic_namespace_output()
    {
        $ns = NamespaceHelper::fromArray(['core', 'utils', 'helpers']);

        $this->assertEquals('Core\\Utils\\Helpers', $ns->toNamespace());
        $this->assertEquals('Core\\Utils\\Helpers', (string) $ns);
        $this->assertEquals('Core\\Utils\\Helpers', $ns->toString());
    }

    public function test_from_string_with_mixed_delimiters_default()
    {
        $ns = NamespaceHelper::fromString('my_module/http-controller');

        // Default delimiters: ['-', '_', '/', '\\']
        $this->assertEquals('My\\Module\\Http\\Controller', $ns->toNamespace());
    }

    public function test_from_string_with_custom_delimiters()
    {
        $ns = NamespaceHelper::fromCaseHelper(
            CaseHelper::from('my_module/http-controller')->setDelimiters(['/'])
        );

        // With only '/' as delimiter, underscores and dashes stay in segment
        $this->assertEquals('MyModule\\HttpController', $ns->toNamespace());
    }

    public function test_from_case_helper_with_default_delimiters()
    {
        $case = CaseHelper::from('core-utils/helpers/path_parser');
        $ns = NamespaceHelper::fromCaseHelper($case);

        $this->assertEquals(
            ['core', 'utils', 'helpers', 'path', 'parser'],
            $ns->getSegments()
        );

        $this->assertEquals('Core\\Utils\\Helpers\\Path\\Parser', $ns->toNamespace());
    }

    public function test_from_case_helper_with_custom_delimiters()
    {
        $case = CaseHelper::from('core-utils/helpers/path_parser')
            ->setDelimiters(['/']);

        $ns = NamespaceHelper::fromCaseHelper($case);

        $this->assertEquals(
            ['core-utils', 'helpers', 'path_parser'],
            $ns->getSegments()
        );

        $this->assertEquals('CoreUtils\\Helpers\\PathParser', $ns->toNamespace());
    }

    public function test_segment_manipulation()
    {
        $ns = NamespaceHelper::fromArray(['App'])
            ->appendSegment('Services')
            ->appendSegment('Logger');

        $this->assertEquals('App\\Services\\Logger', $ns->toNamespace());
    }

    public function test_empty_namespace()
    {
        $ns = NamespaceHelper::fromArray([]);

        $this->assertEquals('', $ns->toNamespace());
        $this->assertEquals('', (string) $ns);
    }
}
