# NamespaceHelper

The `NamespaceHelper` class is a variant of `PathHelper` that generates namespace strings using `\` as a default separator. It ensures consistent PascalCase formatting for each segment using `CaseHelper`.

---

## Basic Usage

```php
use Seworqs\Commons\String\Helper\NamespaceHelper;
use Seworqs\Commons\String\Helper\CaseHelper;

// From array of segments
$ns = NamespaceHelper::fromArray(['core', 'utils', 'helpers']);

echo $ns->toNamespace(); // Core\Utils\Helpers
```

---

## From string input

```php
$ns = NamespaceHelper::fromString('my_module/http_controller');

echo $ns->toNamespace(); // MyModule\HttpController
```

---

## From CaseHelper

```php
use Seworqs\Commons\String\Helper\CaseHelper;

$case = CaseHelper::from('admin-panel/dashboard_view');
$ns = NamespaceHelper::fromCaseHelper($case);

echo $ns->toNamespace(); // Admin\Panel\Dashboard\View
```

---

## String casting

```php
$ns = NamespaceHelper::fromString('domain/services/api');

echo (string) $ns;        // Domain\Services\Api
echo $ns->toString();     // Domain\Services\Api
```

---

## Delimiters in case conversion

By default, `CaseHelper` splits strings using the delimiters `-`, `_`, `/`, and `\\`.  
This can lead to segments being split unexpectedly when used with `NamespaceHelper`.

### Default delimiters (splits on `-`, `_`, `/`, `\`)

```php
$case = CaseHelper::from('core-utils/helpers/path_parser');
$ns = NamespaceHelper::fromCaseHelper($case);

echo $ns->toNamespace(); // Core\Utils\Helpers\Path\Parser
```

### Custom delimiters to preserve segments

```php
$case = CaseHelper::from('core-utils/helpers/path_parser')
    ->setDelimiters(['/']);

$ns = NamespaceHelper::fromCaseHelper($case);

echo $ns->toNamespace(); // CoreUtils\Helpers\PathParser
```

Use `setDelimiters()` to prevent splitting on dashes or underscores if they are part of intended namespace segments.

---

## Segment manipulation (inherited from PathHelper)

```php
$ns = NamespaceHelper::fromArray(['App'])
    ->appendSegment('Services')
    ->appendSegment('Logger');

echo $ns->toNamespace(); // App\Services\Logger
```
