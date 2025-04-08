# RandomHelper

The `RandomHelper` provides a simple static method to generate a random string of a given length using a configurable set of characters (the "heystack").

---

## Basic usage

```php
use Seworqs\Commons\String\Helper\RandomHelper;

$random = RandomHelper::createRandomString();

echo $random; // e.g. "a8pGk2Lm09" (10 characters by default)
```

---

## Custom length

```php
$random = RandomHelper::createRandomString(20);

echo strlen($random); // 20
```

---

## Custom heystack (character set)

```php
$random = RandomHelper::createRandomString(12, 'ABC123');

echo $random; // Only uses characters A, B, C, 1, 2, 3
```

---

## Avoiding confusing characters

To avoid ambiguous characters (like `0` vs `O`, or `I` vs `1`), provide a clean heystack:

```php
$random = RandomHelper::createRandomString(8, 'abcdefghjkmnpqrstuvwxyz23456789');

echo $random; // e.g. "g7mqfhkp"
```

This is useful for display codes or visual tokens where clarity matters.

---

## Exception: empty heystack

Passing an empty string as heystack will throw an `InvalidArgumentException`:

```php
RandomHelper::createRandomString(5, ''); // throws
```

---

## Notes

- Characters are selected with `random_int()` for cryptographic strength.
- Duplicates may occur. If you need uniqueness, add your own validation or collision check.
- This helper is ideal for generating simple tokens, codes, or placeholders.
