<?php

namespace Seworqs\Commons\String\Helper;

class NamespaceHelper extends PathHelper
{
    public function toNamespace(string $separator = '\\'): string
    {
        return implode($separator, array_map(
            fn(string $segment) => CaseHelper::from($segment)->toPascalCase()->toString(),
            $this->segments
        ));
    }

    public function toString(): string
    {
        return $this->toNamespace();
    }

    public function __toString(): string
    {
        return $this->toNamespace();
    }
}
