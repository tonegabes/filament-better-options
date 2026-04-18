# Changelog

All notable changes to `tonegabes/filament-better-options` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.1.0] - 2026-04-18

### Added
- `CheckboxStackedCards`, `CheckboxTable`, `RadioStackedCards` and `RadioTable` components for richer layout choices.
- `ComponentStyles::StackedCards` and `ComponentStyles::Table` enum cases.
- `HasOptionColor` trait: per-option tint driven by `Filament\Support\Contracts\HasColor` on enum cases, with `optionColors()` escape hatch.
- `IconResolverService` with a Heroicons fallback when `tonegabes/filament-phosphor-icons` is not installed; overridable via `config('better-options.icons.defaults')`.
- Full Pest + Testbench test suite covering traits, services, components and themes.
- GitHub Actions workflows: `tests.yml` (PHP 8.2/8.3 matrix), `phpstan.yml`, `fix-php-code-style-issues.yml`.
- `SECURITY.md` and `composer test` / `composer test-coverage` scripts.
- `docs/architecture.md` describing the real package architecture.

### Changed
- `RadioList`, `RadioCards` and `RadioTable` now extend `Filament\Forms\Components\Radio`, preserving native features (`boolean()`, `inline()`, state casts, validation rules).
- `IconManagerService` refactored to delegate defaults to `IconResolverService` and to throw a clear `InvalidArgumentException` when `componentType` is null instead of interpolating a null enum into a string.
- Config access inside `HasIndicator`/`HasOptionIcon` moved to protected helper methods to make traits easier to test and override.
- Internal PT-BR comments translated to English.

### Removed
- Misleading `docs/IMPROVEMENTS_SUMMARY.md` that referenced APIs that were never implemented.

### Dependencies
- `tonegabes/filament-phosphor-icons` is now a `suggest` dependency instead of a hard requirement; projects that already have it installed keep the previous visual defaults.

## [1.0.0] - 2026-04-01

### Added
- Initial release: `CheckboxList`, `CheckboxCards`, `RadioList`, `RadioCards` components with descriptions, extra texts, icons, indicators and `minimal` / `modern` / `classic` themes.
