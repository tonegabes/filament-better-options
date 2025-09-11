# Filament Better Options

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tonegabes/filament-better-options.svg?style=flat-square)](https://packagist.org/packages/tonegabes/filament-better-options)
[![Total Downloads](https://img.shields.io/packagist/dt/tonegabes/filament-better-options.svg?style=flat-square)](https://packagist.org/packages/tonegabes/filament-better-options)
[![Tests](https://img.shields.io/github/actions/workflow/status/tonegabes/filament-better-options/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tonegabes/filament-better-options/actions/workflows/run-tests.yml)
[![PHPStan](https://img.shields.io/github/actions/workflow/status/tonegabes/filament-better-options/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/tonegabes/filament-better-options/actions/workflows/phpstan.yml)

Enhanced checkbox and radio button components for Filament Forms with modern UI, advanced features, and excellent performance. Provides `CheckboxList`, `CheckboxCards`, `RadioList`, and `RadioCards` with icons, visual indicators, descriptions, extra text, search functionality, and bulk operations.

## Features

✨ **Enhanced UI Components**

- Modern card-based and list layouts
- Customizable visual indicators with Phosphor icons
- Flexible icon positioning (before/after)
- Support for descriptions and extra text

🔍 **Advanced Functionality**

- Real-time search with debounced input
- Bulk select/deselect operations for checkboxes
- Configurable positioning and visibility
- Performance-optimized JavaScript

🎨 **Customization**

- Tailwind CSS styling with dark mode support
- Configurable default positions via config file
- Extensible architecture with traits and concerns
- Full accessibility support

⚡ **Performance**

- Optimized CSS build process with PurgeCSS
- Efficient DOM operations and caching
- Lazy-loaded Alpine.js components
- Minimal JavaScript footprint

## Requirements

- PHP 8.3+
- Laravel 11.0+
- Filament 4.0+

## Installation

Install the package via Composer:

```bash
composer require tonegabes/filament-better-options
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag="better-options-config"
```

Optionally, publish the assets for customization:

```bash
php artisan vendor:publish --tag="better-options-assets"
```

## Configuration

The published configuration file (`config/better-options.php`) allows you to customize default positions:

```php
<?php

return [
    'default_positions' => [
        'checkbox_list' => [
            'icon'      => 'after',
            'indicator' => 'before',
        ],
        'checkbox_cards' => [
            'icon'      => 'before',
            'indicator' => 'after',
        ],
        'radio_list' => [
            'icon'      => 'after',
            'indicator' => 'before',
        ],
        'radio_cards' => [
            'icon'      => 'before',
            'indicator' => 'after',
        ],
    ],
];
```

## Usage

### Basic Examples

```php
use ToneGabes\BetterOptions\Forms\Components\CheckboxCards;
use ToneGabes\BetterOptions\Forms\Components\CheckboxList;
use ToneGabes\BetterOptions\Forms\Components\RadioCards;
use ToneGabes\BetterOptions\Forms\Components\RadioList;

// Checkbox Cards with full features
CheckboxCards::make('features')
    ->options([
        'performance' => 'High Performance',
        'security' => 'Enhanced Security',
        'scalability' => 'Auto Scaling',
    ])
    ->descriptions([
        'performance' => 'Optimized for large datasets',
        'security' => 'Enterprise-grade security',
        'scalability' => 'Scales with your needs',
    ])
    ->extraTexts([
        'performance' => 'Recommended',
        'security' => 'Popular',
    ])
    ->icons([
        'performance' => 'heroicon-o-bolt',
        'security' => 'heroicon-o-shield-check',
        'scalability' => 'heroicon-o-arrow-trending-up',
    ])
    ->columns(2)
    ->searchable()
    ->bulkToggleable();

// Simple Radio List
RadioList::make('subscription_plan')
    ->options([
        'free' => 'Free Plan',
        'pro' => 'Pro Plan',
        'enterprise' => 'Enterprise Plan',
    ])
    ->descriptions([
        'free' => 'Perfect for getting started',
        'pro' => 'Great for growing teams',
        'enterprise' => 'Full-featured solution',
    ]);
```

### Advanced Features

#### Search and Bulk Operations

```php
CheckboxList::make('permissions')
    ->options($this->getPermissionOptions())
    ->searchable()
    ->searchPrompt('Search permissions...')
    ->searchDebounce('300ms')
    ->bulkToggleable()
    ->selectAllAction(
        Action::make('selectAll')
            ->label('Select All')
            ->icon('heroicon-o-check-circle')
    )
    ->deselectAllAction(
        Action::make('deselectAll')
            ->label('Clear All')
            ->icon('heroicon-o-x-circle')
    );
```

#### Custom Positioning and Visibility

```php
CheckboxCards::make('tools')
    ->options($this->getToolOptions())
    ->iconBefore()
    ->indicatorAfter()
    ->hiddenDescription(fn() => $this->compact_mode)
    ->hiddenExtraText(fn() => !$this->show_pricing)
    ->partiallyHiddenIndicator(fn() => $this->minimal_ui)
    ->itemsCenter();
```

#### Icons and Indicators

```php
RadioCards::make('theme')
    ->options([
        'light' => 'Light Theme',
        'dark' => 'Dark Theme',
        'auto' => 'Auto Theme',
    ])
    ->icons([
        'light' => 'heroicon-o-sun',
        'dark' => 'heroicon-o-moon',
        'auto' => 'heroicon-o-computer-desktop',
    ])
    ->idleIndicator('heroicon-o-circle')
    ->selectedIndicator('heroicon-o-check-circle')
    ->columns(3);
```

### Available Components

| Component       | Description                    | Features                               |
| --------------- | ------------------------------ | -------------------------------------- |
| `CheckboxList`  | Vertical list of checkboxes    | Search, Bulk toggle, Icons             |
| `CheckboxCards` | Grid of checkbox cards         | All list features + Columns, Centering |
| `RadioList`     | Vertical list of radio buttons | Icons, Custom indicators               |
| `RadioCards`    | Grid of radio button cards     | All list features + Columns, Centering |

### Component Methods

#### Common Methods (All Components)

```php
// Content
->options(array $options)
->descriptions(array $descriptions)
->extraTexts(array $extraTexts)
->hiddenDescription(bool|Closure $condition = true)
->hiddenExtraText(bool|Closure $condition = true)

// Icons and Indicators
->icons(array $icons)
->iconBefore()
->iconAfter()
->hiddenIcon(bool|Closure $condition = true)
->idleIndicator(string $icon)
->selectedIndicator(string $icon)
->indicatorBefore()
->indicatorAfter()
->hiddenIndicator(bool|Closure $condition = true)
->partiallyHiddenIndicator(bool|Closure $condition = true)
```

#### Checkbox-Specific Methods

```php
// Search functionality
->searchable(bool $condition = true)
->searchPrompt(string $prompt)
->searchDebounce(string $debounce = '500ms')

// Bulk operations
->bulkToggleable(bool $condition = true)
->selectAllAction(Action $action)
->deselectAllAction(Action $action)
```

#### Card-Specific Methods

```php
// Layout
->columns(int|array $columns)
->itemsCenter(bool|Closure $condition = true)
```

### Styling and Theming

The package uses Tailwind CSS classes and supports Filament's theming system. Key CSS classes:

```css
/* Component containers */
.fi-fo-checkbox-list
.fi-fo-checkbox-card
.fi-fo-radio-list

/* Individual options */
.fi-fo-checkbox-option
.fi-fo-radio-item

/* Content elements */
.fi-fo-checkbox-option__label
.fi-fo-checkbox-option__description
.fi-fo-checkbox-option__extra
.fi-fo-checkbox-option__icon
.fi-fo-checkbox-option__indicator

/* State classes */
.is-selected
.is-centered
.is-indicator-partially-hidden;
```

### Performance Optimization

The package includes several performance optimizations:

- **CSS Optimization**: Production builds use PurgeCSS to remove unused styles
- **JavaScript Optimization**: Debounced search, cached DOM queries, batched operations
- **Lazy Loading**: Alpine.js components load only when needed

To build optimized assets:

```bash
# Development build
npm run build:dev

# Production build (with PurgeCSS)
npm run build
```

## Development

### Building Assets

```bash
# Install dependencies
npm install

# Development build with watch
npm run dev

# Production build
npm run build
```

### Running Tests

```bash
# Run all tests
composer test

# Run specific test suites
composer test-unit
composer test-feature

# Generate coverage report
composer test-coverage
```

### Code Quality

```bash
# Format code
composer format

# Static analysis
composer analyze
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Upgrade Guide

### From v1.x to v2.x

**Breaking Changes:**

- Configuration structure has changed
- Some CSS classes have been renamed
- Icon provider system introduced

**Migration Steps:**

1. Update your configuration file structure
2. Replace any hardcoded Phosphor icon references
3. Update custom CSS selectors if you have any

See the [UPGRADE.md](UPGRADE.md) file for detailed migration instructions.

## Contributing

We welcome contributions! Please see [CONTRIBUTING.md](.github/CONTRIBUTING.md) for details.

**Development Setup:**

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new functionality
5. Ensure all tests pass
6. Submit a pull request

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tone Gabes](https://github.com/tonegabes) - Creator and maintainer
- [All Contributors](../../contributors) - Thank you for your contributions!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
