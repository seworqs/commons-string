<?php

namespace Seworqs\Commons\String\Helper;

use Seworqs\Commons\String\Helper\CaseHelper;

class PathHelper
{
    protected array $segments;

    public static function fromString(string $input, array $delimiters = [' ', '-', '_', '/', '\\']): static
    {
        $normalized = str_replace($delimiters, '/', $input);
        $segments = array_filter(explode('/', $normalized), fn($v) => $v !== '');

        return new static($segments);
    }

    public static function fromArray(array $segments): static
    {
        return new static($segments);
    }

    public static function fromCaseHelper(CaseHelper $helper): static
    {
        return new static($helper->getSegments());
    }

    public function __construct(array $segments)
    {
        $this->segments = $segments;
    }

    public function toPath(string $separator = '/'): string
    {
        return implode($separator, $this->segments);
    }

    public function toSnakePath(string $separator = '/'): string
    {
        return implode($separator, array_map(
            fn($s) => CaseHelper::from($s)->toSnakeCase()->toString(),
            $this->segments
        ));
    }

    public function toPascalPath(string $separator = '/'): string
    {
        return implode($separator, array_map(
            fn($s) => CaseHelper::from($s)->toPascalCase()->toString(),
            $this->segments
        ));
    }

    public function toCamelPath(string $separator = '/'): string
    {
        return implode($separator, array_map(
            fn($s) => CaseHelper::from($s)->toCamelCase()->toString(),
            $this->segments
        ));
    }

    public function toKebabPath(string $separator = '/'): string
    {
        return implode($separator, array_map(
            fn($s) => CaseHelper::from($s)->toKebabCase()->toString(),
            $this->segments
        ));
    }

    public function getSegments(): array
    {
        return $this->segments;
    }

    public function appendSegment(string $segment): static
    {
        $clone = clone $this;
        $clone->segments[] = $segment;
        return $clone;
    }

    public function prependSegment(string $segment): static
    {
        $clone = clone $this;
        array_unshift($clone->segments, $segment);
        return $clone;
    }
}
