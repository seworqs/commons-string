# CaseHelper

The `CaseHelper` class helps to convert string values into different casing styles like `camelCase`, `snake_case`, `kebab-case`, etc., with support for custom delimiters. It is immutable and supports method chaining.

---

## Basic Usage

```php
use Seworqs\Commons\String\Helper\CaseHelper;
use Seworqs\Commons\String\Enum\EnumCaseType;

// Create a CaseHelper instance from a string
$helper = CaseHelper::from('my-example_string/value');

// The default delimiters are ['-', '_', '/', '\\']. That's how a string will be split.

// Convert to different casing styles
echo $helper->convertTo(EnumCaseType::CAMEL);           // myExampleStringValue
echo $helper->convertTo(EnumCaseType::PASCAL);          // MyExampleStringValue
echo $helper->convertTo(EnumCaseType::SNAKE);           // my_example_string_value
echo $helper->convertTo(EnumCaseType::SCREAMING_SNAKE); // MY_EXAMPLE_STRING_VALUE
echo $helper->convertTo(EnumCaseType::KEBAB);           // my-example-string-value
echo $helper->convertTo(EnumCaseType::SCREAMING_KEBAB); // MY-EXAMPLE-STRING-VALUE
echo $helper->convertTo(EnumCaseType::TITLE);           // MyExampleStringValue
echo $helper->convertTo(EnumCaseType::UPPER);           // MY-EXAMPLE_STRING/VALUE
echo $helper->convertTo(EnumCaseType::LOWER);           // my-example_string/value
echo $helper->convertTo(EnumCaseType::ORIGINAL);        // my-example_string/value

// Get the original value
echo $helper->getOriginal(); // my-example_string/value
```

---

## Advanced Usage

### Chaining conversions

```php
echo CaseHelper::from('custom/chain-case')
    ->toPascalCase()
    ->toUpperCase(); // CUSTOMCHAINCASE
```

### Custom delimiters

```php
$helper = CaseHelper::from('custom.delimiter|example');

// Get the default delimiters.
$delimiters = $helper->getDelimiters(); // ['-', '_', '/', '\\']

// Replace all default delimiters with your own
$helper = $helper->setDelimiters(['.', '|']);

echo $helper->toCamelCase(); // customDelimiterExample
```

### Adding a delimiter

```php
$helper = CaseHelper::from('abc.def|ghi')
    ->addDelimiter('.')
    ->addDelimiter('|');

echo $helper->toSnakeCase(); // abc_def_ghi
```

### Removing a delimiter

```php
$helper = CaseHelper::from('abc-def_ghi')
    ->removeDelimiter('-');

echo $helper->toPascalCase(); // Abc-defGhi
```

---

## Edge Cases

### Empty string

```php
$helper = CaseHelper::from('');

echo $helper->convertTo(EnumCaseType::CAMEL); // ''
```

### No recognized delimiters

```php
$helper = CaseHelper::from('justplainstring');

echo $helper->toSnakeCase(); // justplainstring
```

### Consecutive delimiters

```php
$helper = CaseHelper::from('one--two///three');

echo $helper->toKebabCase(); // one-two-three
```

### Unicode input

```php
$helper = CaseHelper::from('föo-bär');

echo $helper->convertTo(EnumCaseType::UPPER); // FÖO-BÄR
```

### Segmentation

```php
$helper = CaseHelper::from('aa_bb/cc');

print_r($helper->getSegments());
// ['aa', 'bb', 'cc']
```

---

## Why use CaseHelper?

- Consistent transformation of user input or identifiers
- Fully immutable design: chaining does not mutate previous states
- Works with custom or complex delimiters
- Clean integration with enums (e.g. `EnumCaseType`)
- Handles edge cases and Unicode safely

