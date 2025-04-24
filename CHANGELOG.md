# CHANGELOG

## v2.0.0

### Added
- Added toPascalPath() in PathHelper
- More unit tests

### Changed
- Shuffling haystack in RandomString 1-10 times before use
- Typo (heystack => haystack)

### Fixed
- Bug in getSegments, now using another temp splitter (not /)
- Namespace in unit tests.

### Removed
- protected function splitAndCapitalize(). 
  You can use the more powerful CaseHelper::from(...)->toPascal()->toString() ---

### Other
- Optimalization in toPascalCase() (using getSegments, avoiding duplicate code)

--- 

## v1.1.0
We changed the default delimiters by adding a space. 
This could have effect on existing strings that you transform! 

### Changed
- Added `' '` to default delimiters in `CaseHelper` and `PathHelper`

--- 
## v1.0.3

No functional changes.

### Added
- Added keywords to composer.json

### Changes
- Description in composer.json
- Intro in README.md

--- 

## v1.0.2

### Added 
- PHP Requirement in composer.json

---

## v1.0.1

### Fixed
- Wrong composer name
- Wrong composer description

---

## v1.0.0

### Added
- Initial release
