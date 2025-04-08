<?php

namespace Seworqs\Commons\String\Enum;

enum EnumCaseType: string
{
    case ORIGINAL          = 'original';
    case PASCAL            = 'pascal';
    case CAMEL             = 'camel';
    case SNAKE             = 'snake';
    case KEBAB             = 'kebab';
    case SCREAMING_SNAKE   = 'screaming_snake';
    case SCREAMING_KEBAB   = 'screaming_kebab';
    case TITLE             = 'title';
    case UPPER             = 'upper';
    case LOWER             = 'lower';
}
