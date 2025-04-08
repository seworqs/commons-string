# SEworqs Commons String

A collection of helpful string utilities for PHP developers.  
Includes case conversion, path/namespace formatting, and random string generation.

---

## Installation

Install via Composer:

```bash
composer require seworqs/commons-string
```

---

## Basic Usage

```php
use Seworqs\Commons\String\Helper\CaseHelper;
use Seworqs\Commons\String\Helper\RandomHelper;
use Seworqs\Commons\String\Helper\PathHelper;
use Seworqs\Commons\String\Helper\NamespaceHelper;

// CaseHelper: Convert strings to different casing styles
$camel  = CaseHelper::from('This is some text')->toCamelCase()->toString();    // thisIsSomeText
$pascal = CaseHelper::from('This is some text')->toPascalCase()->toString();   // ThisIsSomeText

// RandomHelper: Generate random strings
$default = RandomHelper::createRandomString();                                  // 10 chars
$custom  = RandomHelper::createRandomString(12, 'abdef1234567890');             // Safe character set

// PathHelper: Build path-like structures
$path = PathHelper::fromString('src/utilities/logger');
echo $path->toKebabPath(); // src/utilities/logger

// NamespaceHelper: Format segments as a PHP namespace
$ns = NamespaceHelper::fromString('domain/shared/logger_service');
echo $ns->toNamespace(); // Domain\Shared\LoggerService
```

---

## More Examples

- [CaseHelper examples](docs/Examples/CaseHelper.md)
- [RandomHelper examples](docs/Examples/RandomHelper.md)
- [NamespaceHelper examples](docs/Examples/NamespaceHelper.md)
- [PathHelper examples](docs/Examples/PathHelper.md)

---

## Features

- ✅ Transform strings to common casing styles (camelCase, PascalCase, kebab-case, etc.)
- ✅ Support for custom delimiters and method chaining
- ✅ Path and namespace formatting
- ✅ Generate secure random strings with a custom character set

> See our full [examples overview](docs/Examples.md)

---

## Classes and Namespaces

| Namespace                                      | Description                                      |
|------------------------------------------------|--------------------------------------------------|
| Seworqs\Commons\String\Helpers\CaseHelper      | Converts strings into various casing styles.     |
| Seworqs\Commons\String\Helpers\PathHelper      | Builds and transforms path-like string segments. |
| Seworqs\Commons\String\Helpers\NamespaceHelper | Formats segments as valid PHP namespaces.        |
| Seworqs\Commons\String\Helpers\RandomHelper    | Generates secure random strings.                 |

---

## License

Apache-2.0 — see [LICENSE](./LICENSE)

---

## About SEworqs

SEworqs builds clean, reusable modules for PHP and Mendix developers.  
Learn more at [github.com/seworqs](https://github.com/seworqs)

---

## Badges

[![Latest Version](https://img.shields.io/packagist/v/seworqs/commons-string.svg?style=flat-square)](https://packagist.org/packages/seworqs/commons-string)  
[![Total Downloads](https://img.shields.io/packagist/dt/seworqs/commons-string.svg?style=flat-square)](https://packagist.org/packages/seworqs/commons-string)  
[![License](https://img.shields.io/packagist/l/seworqs/commons-string?style=flat-square)](https://packagist.org/packages/seworqs/commons-string)  
[![PHP Version](https://img.shields.io/packagist/php-v/seworqs/commons-string.svg?style=flat-square)](https://packagist.org/packages/seworqs/commons-string)  
[![Made by SEworqs](https://img.shields.io/badge/made%20by-SEworqs-002d74?style=flat-square)](https://github.com/seworqs)
