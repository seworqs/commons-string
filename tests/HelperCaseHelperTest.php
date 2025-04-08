<?php

namespace Tests\Seworqs\Commons\String\Helper;

use PHPUnit\Framework\TestCase;
use Seworqs\Commons\String\Helper\CaseHelper;
use Seworqs\Commons\String\Enum\EnumCaseType;
use InvalidArgumentException;

class HelperCaseHelperTest extends TestCase
{
    public function test_basic_case_conversions()
    {
        $helper = CaseHelper::from('test-string_value/sample');

        $this->assertEquals('testStringValueSample', $helper->convertTo(EnumCaseType::CAMEL)->toString());
        $this->assertEquals('TestStringValueSample', $helper->convertTo(EnumCaseType::PASCAL)->toString());
        $this->assertEquals('test_string_value_sample', $helper->convertTo(EnumCaseType::SNAKE)->toString());
        $this->assertEquals('TEST_STRING_VALUE_SAMPLE', $helper->convertTo(EnumCaseType::SCREAMING_SNAKE)->toString());
        $this->assertEquals('test-string-value-sample', $helper->convertTo(EnumCaseType::KEBAB)->toString());
        $this->assertEquals('TEST-STRING-VALUE-SAMPLE', $helper->convertTo(EnumCaseType::SCREAMING_KEBAB)->toString());
        $this->assertEquals('TestStringValueSample', $helper->convertTo(EnumCaseType::TITLE)->toString());
        $this->assertEquals('TEST-STRING_VALUE/SAMPLE', $helper->convertTo(EnumCaseType::UPPER)->toString());
        $this->assertEquals('test-string_value/sample', $helper->convertTo(EnumCaseType::LOWER)->toString());
        $this->assertEquals('test-string_value/sample', $helper->convertTo(EnumCaseType::ORIGINAL)->toString());
    }

    public function test_get_original_and_string_casting()
    {
        $helper = CaseHelper::from('abc-def');
        $this->assertEquals('abc-def', $helper->getOriginal());
        $this->assertEquals('abc-def', (string) $helper);
    }

    public function test_chaining_and_immutability()
    {
        $helper = CaseHelper::from('chain-test');

        $camel = $helper->toCamelCase();
        $upper = $camel->toUpperCase();

        $this->assertEquals('chainTest', $camel->toString());
        $this->assertEquals('CHAINTEST', $upper->toString());

        // Ensure original is unchanged
        $this->assertEquals('chain-test', $helper->getOriginal());
    }

    public function test_custom_delimiters()
    {
        $helper = CaseHelper::from('custom.delim|string')
            ->setDelimiters(['.', '|']);

        $this->assertEquals('customDelimString', $helper->toCamelCase()->toString());
    }

    public function test_add_delimiter_and_remove_delimiter()
    {
        $helper = CaseHelper::from('abc.def|ghi');

        $modified = $helper
            ->addDelimiter('.')
            ->addDelimiter('|');

        $this->assertEquals('abc_def_ghi', $modified->toSnakeCase()->toString());

        $removed = $modified->removeDelimiter('|');
        $this->assertEquals('AbcDef|ghi', $removed->toPascalCase()->toString());
    }

    public function test_add_delimiters_validity()
    {
        $this->expectException(InvalidArgumentException::class);
        CaseHelper::from('x')->addDelimiters(['_', 123]);
    }

    public function test_get_segments()
    {
        $segments = CaseHelper::from('aa_bb/cc')->getSegments();
        $this->assertEquals(['aa', 'bb', 'cc'], array_values($segments));
    }

    public function test_empty_string()
    {
        $helper = CaseHelper::from('');

        $this->assertEquals('', $helper->toCamelCase()->toString());
        $this->assertEquals('', $helper->convertTo(EnumCaseType::UPPER)->toString());
    }

    public function test_no_delimiters()
    {
        $helper = CaseHelper::from('nodividers');

        $this->assertEquals('nodividers', $helper->toSnakeCase()->toString());
    }

    public function test_consecutive_delimiters()
    {
        $helper = CaseHelper::from('one--two///three');

        $this->assertEquals('one-two-three', $helper->toKebabCase()->toString());
    }

    public function test_unicode_handling()
    {
        $helper = CaseHelper::from('föö-bär');

        $this->assertEquals('FÖÖ-BÄR', $helper->convertTo(EnumCaseType::UPPER)->toString());
    }

    public function test_set_delimiters_isolated()
    {
        $helper1 = CaseHelper::from('a.b.c')->setDelimiters(['.']);
        $helper2 = $helper1->addDelimiter('|');

        $this->assertEquals(['.'], $helper1->getDelimiters());
        $this->assertContains('|', $helper2->getDelimiters());
    }
}
