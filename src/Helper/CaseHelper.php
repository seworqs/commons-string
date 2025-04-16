<?php

namespace Seworqs\Commons\String\Helper;

use Seworqs\Commons\String\Enum\EnumCaseType;

class CaseHelper
{

    protected string $original;
    protected string $value;
    protected array $delimiters = [' ', '-', '_', '/', '\\'];

    ////////////////////
    // CONSTRUCTOR
    ////////////////////
    public function __construct(string $value) {
        $this->original = $this->value = $value;
    }

    ////////////////////
    // PUBLIC METHODS
    ////////////////////
    public static function from(string $value): static
    {
        return new static($value);
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function getDelimiters(): array {
        return $this->delimiters;
    }

    public function setDelimiters(array $delimiters): static
    {
        $clone = clone $this;
        $clone->delimiters = $delimiters;
        return $clone;
    }

    public function addDelimiters(array $delimiters): static
    {
        $clone = clone $this;

        foreach ($delimiters as $delimiter) {
            if (!is_string($delimiter)) {
                throw new \InvalidArgumentException("All delimiters must be strings.");
            }
            $clone->delimiters[] = $delimiter;
        }

        $clone->delimiters = array_unique($clone->delimiters);
        return $clone;
    }

    public function addDelimiter(string $delimiter): static
    {
        $clone = clone $this;
        $clone->delimiters[] = $delimiter;
        $clone->delimiters = array_unique($clone->delimiters);
        return $clone;
    }

    public function removeDelimiter(string $delimiter): static
    {
        $clone = clone $this;
        $clone->delimiters = array_filter(
            $clone->delimiters,
            fn($d) => $d !== $delimiter
        );
        return $clone;
    }

    public function convertTo(EnumCaseType $type): static
    {
        return match ($type) {
            EnumCaseType::ORIGINAL         => self::from($this->original),
            EnumCaseType::PASCAL           => $this->toPascalCase(),
            EnumCaseType::CAMEL            => $this->toCamelCase(),
            EnumCaseType::SNAKE            => $this->toSnakeCase(),
            EnumCaseType::KEBAB            => $this->toKebabCase(),
            EnumCaseType::SCREAMING_SNAKE  => $this->toSnakeCase()->toUpperCase(),
            EnumCaseType::SCREAMING_KEBAB  => $this->toKebabCase()->toUpperCase(),
            EnumCaseType::TITLE            => $this->toPascalCase(),
            EnumCaseType::UPPER            => $this->toUpperCase(),
            EnumCaseType::LOWER            => $this->toLowerCase(),
        };
    }

    public function toPascalCase(): static
    {
        $clone = clone $this;

        $pattern = '/[' . preg_quote(implode('', $clone->delimiters), '/') . ']+/';
        $parts = preg_split($pattern, trim($clone->value));

        $clone->value = implode('', array_map('ucfirst', $parts));
        return $clone;
    }

    public function toCamelCase(): static
    {
        $pascal = $this->toPascalCase();
        $clone = clone $pascal;
        $clone->value = lcfirst($clone->value);
        return $clone;
    }

    public function toSnakeCase(): static
    {
        return $this->toSeparatedCase('_')->toLowerCase();
    }

    public function toKebabCase(): static
    {
        return $this->toSeparatedCase('-')->toLowerCase();
    }

    public function toUpperCase(): static
    {
        $clone = clone $this;
        $clone->value = function_exists('mb_strtoupper')
            ? mb_strtoupper($clone->value, 'UTF-8')
            : strtoupper($clone->value);
        return $clone;
    }

    public function toLowerCase(): static
    {
        $clone = clone $this;
        $clone->value = function_exists('mb_strtolower')
            ? mb_strtolower($clone->value, 'UTF-8')
            : strtolower($clone->value);
        return $clone;
    }

    public function getSegments(): array
    {
        $pattern = '/[' . preg_quote(implode('', $this->delimiters), '/') . ']+/';
        return array_filter(preg_split($pattern, trim($this->value)), fn($v) => $v !== '');
    }

    ////////////////////
    // PROTECTED METHODS
    ////////////////////

    protected function splitAndCapitalize(string $segment): string
    {
        $parts = preg_split('/[ _-]+/', $segment);
        return implode('', array_map('ucfirst', $parts));
    }

    protected function toSeparatedCase(string $separator): static
    {
        $pascal = $this->toPascalCase();
        $clone = clone $pascal;

        $parts = preg_split('/(?=[A-Z])/', $clone->value, -1, PREG_SPLIT_NO_EMPTY);
        $clone->value = implode($separator, $parts);
        return $clone;
    }

    ////////////////////
    // PRIVATE METHODS
    ////////////////////
}
