# PathHelper

The `PathHelper` provides an immutable and flexible way to build and transform path-like structures. It works in combination with `CaseHelper` to ensure consistent case conversion.

---
### Terminology

- **Delimiters** are used in `fromString()` to split a string into segments. Default delimiters include `-`, `_`, `/`, and `\\`.
- **Separator** is used in methods like `toPath()`, `toSnakePath()` or `toKebabPath()` to join segments back into a path string. Common separators are `/`, `.`, `_`, etc.

> Example:
> ```php
> $helper = PathHelper::fromString('App/Http/Controllers');
> echo $helper->toSnakePath('.'); // app.http.controllers
> ```
> Here, `/` is the delimiter (one of the default delimiters) used to split the string, and `.` is the separator used to join the output.


## Basic Usage

```php
use Seworqs\Commons\String\Helper\PathHelper;

$helper = PathHelper::fromString('App/Http/Controllers');

echo $helper->toPath();            // App/Http/Controllers
echo $helper->toKebabPath();       // app/http/controllers
echo $helper->toSnakePath();       // app_http_controllers
echo $helper->toCamelPath();       // app/http/controllers
```

---

## Advanced Usage

### Use with CaseHelper

```php
use Seworqs\Commons\String\Helper\CaseHelper;
use Seworqs\Commons\String\Helper\PathHelper;

$caseHelper = CaseHelper::from('my-app/controller-name');
$pathHelper = PathHelper::fromCaseHelper($caseHelper);

print_r($pathHelper->getSegments());
// ['my', 'app', 'controller', 'name']

echo $pathHelper->toKebabPath(); // my/app/controller/name
```

### Appending and Prepending Segments

```php
$helper = PathHelper::fromArray(['core', 'module'])
    ->appendSegment('service')
    ->prependSegment('src');

echo $helper->toPath(); // src/core/module/service
```

### Custom Separator

```php
$helper = PathHelper::fromString('App/Http/Controllers');

echo $helper->toSnakePath('.'); // app.http.controllers
```

---

## Edge Cases

### Empty Input

```php
$helper = PathHelper::fromString('');

print_r($helper->getSegments()); // []
echo $helper->toPath(); // ''
```

### Unicode-safe segments

```php
$helper = PathHelper::fromArray(['FööController', 'Äpi']);

echo $helper->toKebabPath(); // föö-controller/äpi
```

---

## Why use PathHelper?

- Converts segment casing via `CaseHelper`
- Safe, immutable transformations
- Useful for path construction, class autoloading, routing
- Clean segment management (append, prepend, split)
- Works safely with Unicode and custom separators

