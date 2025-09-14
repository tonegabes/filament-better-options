# Filament Better Options

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tonegabes/filament-better-options.svg?style=flat-square)](https://packagist.org/packages/tonegabes/filament-better-options)
[![Total Downloads](https://img.shields.io/packagist/dt/tonegabes/filament-better-options.svg?style=flat-square)](https://packagist.org/packages/tonegabes/filament-better-options)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tonegabes/filament-better-options/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tonegabes/filament-better-options/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/tonegabes/filament-better-options/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/tonegabes/filament-better-options/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)

Enhanced form components for Filament Forms with modern interface, advanced features, and excellent performance. Provides `CheckboxList`, `CheckboxCards`, `RadioList`, and `RadioCards` with icons, visual indicators, descriptions, extra texts, search functionality, and bulk operations.

## ✨ Features

### 🎨 Enhanced UI Components
- Modern card and list layouts
- Extensible icon system with multiple providers (Phosphor, Heroicons)
- Flexible icon positioning (before/after)
- Support for descriptions and extra texts
- Pre-defined themes (minimal, modern, classic)

### 🔍 Advanced Features
- Real-time search with debounced input
- Bulk select/deselect operations for checkboxes
- Configurable positioning and visibility
- Performance-optimized JavaScript
- Icon validation and debug tools

### 🏗️ Extensible Architecture
- Multiple icon provider support
- Trait system for maximum flexibility
- Tailwind CSS styling with dark mode support
- Configurable default positions and icons via config file
- Full accessibility support

### ⚡ Performance & Caching
- Intelligent icon caching system
- Efficient DOM operations and caching
- Alpine.js components loaded on demand
- Minimal JavaScript footprint

## 📋 Requirements

- PHP 8.3+
- Laravel 11.0+
- Filament 4.0+

## 🚀 Installation

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

## ⚙️ Configuration

The published configuration file (`config/better-options.php`) provides extensive customization options:

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Positions
    |--------------------------------------------------------------------------
    |
    | Configure the default positions for icons and indicators in each type
    | of component. Possible values: 'before', 'after'
    |
    */
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

## 📖 Usage

### Basic Examples

```php
use ToneGabes\BetterOptions\Forms\Components\CheckboxCards;
use ToneGabes\BetterOptions\Forms\Components\CheckboxList;
use ToneGabes\BetterOptions\Forms\Components\RadioCards;
use ToneGabes\BetterOptions\Forms\Components\RadioList;

// Checkbox Cards with full features
CheckboxCards::make('features')
    ->label('Desired Features')
    ->options([
        'performance' => 'High Performance',
        'security' => 'Advanced Security',
        'scalability' => 'Auto Scaling',
    ])
    ->descriptions([
        'performance' => 'Optimized for large data volumes',
        'security' => 'Enterprise-level security',
        'scalability' => 'Scales with your needs',
    ])
    ->extraTexts([
        'performance' => 'Recommended',
        'security' => 'Popular',
    ])
    ->icons([
        'performance' => 'phosphor-lightning',
        'security' => 'phosphor-shield-check',
        'scalability' => 'phosphor-trend-up',
    ])
    ->columns(2)
    ->searchable()
    ->bulkToggleable();

// Simple Radio List
RadioList::make('subscription_plan')
    ->label('Subscription Plan')
    ->options([
        'free' => 'Free Plan',
        'pro' => 'Pro Plan',
        'enterprise' => 'Enterprise Plan',
    ])
    ->descriptions([
        'free' => 'Perfect for getting started',
        'pro' => 'Great for growing teams',
        'enterprise' => 'Complete solution',
    ]);
```

### Advanced Features

#### Search and Bulk Operations

```php
CheckboxList::make('permissions')
    ->label('User Permissions')
    ->options($this->getPermissionOptions())
    ->searchable()
    ->searchPrompt('Search permissions...')
    ->searchDebounce('300ms')
    ->bulkToggleable()
    ->selectAllAction(
        Action::make('selectAll')
            ->label('Select All')
            ->icon('phosphor-check-circle')
    )
    ->deselectAllAction(
        Action::make('deselectAll')
            ->label('Clear Selection')
            ->icon('phosphor-x-circle')
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
    ->label('Application Theme')
    ->options([
        'light' => 'Light Theme',
        'dark' => 'Dark Theme',
        'auto' => 'Auto Theme',
    ])
    ->icons([
        'light' => 'phosphor-sun',
        'dark' => 'phosphor-moon',
        'auto' => 'phosphor-circle-half',
    ])
    ->idleIndicator('phosphor-circle')
    ->selectedIndicator('phosphor-check-circle')
    ->columns(3);
```

### Pre-defined Themes

```php
// Modern Theme - Icons before, indicators after, centered
CheckboxCards::make('options')
    ->options($options)
    ->theme('modern');

// Minimal Theme - Subtle indicators
CheckboxCards::make('options')
    ->options($options)
    ->theme('minimal');

// Classic Theme - Traditional layout
CheckboxCards::make('options')
    ->options($options)
    ->theme('classic');
```

## 📚 Available Components

| Component        | Description                      | Features                                           |
| ---------------- | -------------------------------- | -------------------------------------------------- |
| `CheckboxList`   | Vertical list of checkboxes      | Search, Bulk toggle, Icons                        |
| `CheckboxCards`  | Grid of checkbox cards           | All list features + Columns, Centering            |
| `RadioList`      | Vertical list of radio buttons   | Icons, Custom indicators                           |
| `RadioCards`     | Grid of radio button cards       | All list features + Columns, Centering            |

## 🔧 Component Methods

### Common Methods (All Components)

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

### Checkbox-Specific Methods

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

### Card-Specific Methods

```php
// Layout
->columns(int|array $columns)
->itemsCenter(bool|Closure $condition = true)

// Themes
->theme(string $theme) // 'minimal', 'modern', 'classic'
```

## 🎨 Styling and Themes

The package uses Tailwind CSS classes and supports Filament's theming system. Main CSS classes:

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
.is-indicator-partially-hidden
```

## 🚀 Performance Optimization

The package includes several performance optimizations:

- **CSS Optimization**: Production builds use PurgeCSS to remove unused styles
- **JavaScript Optimization**: Debounced search, cached DOM queries, batch operations
- **Lazy Loading**: Alpine.js components load only when needed

To build optimized assets:

```bash
# Development build
npm run build:dev

# Production build (with PurgeCSS)
npm run build
```

## 💡 Practical Examples

### E-commerce - Category Selection

```php
CheckboxCards::make('product_categories')
    ->label('Categories of Interest')
    ->options([
        'electronics' => 'Electronics',
        'fashion' => 'Fashion & Clothing',
        'home_garden' => 'Home & Garden',
        'sports' => 'Sports & Leisure',
    ])
    ->icons([
        'electronics' => 'phosphor-device-mobile',
        'fashion' => 'phosphor-tshirt',
        'home_garden' => 'phosphor-house',
        'sports' => 'phosphor-soccer-ball',
    ])
    ->descriptions([
        'electronics' => 'Smartphones, laptops, gadgets',
        'fashion' => 'Men\'s and women\'s clothing',
        'home_garden' => 'Decoration and gardening',
        'sports' => 'Sports equipment',
    ])
    ->extraTexts([
        'electronics' => 'Best seller',
        'fashion' => 'Trending',
    ])
    ->theme('modern')
    ->columns(2)
    ->searchable()
    ->bulkToggleable();
```

### Permission System

```php
CheckboxCards::make('user_permissions')
    ->label('User Permissions')
    ->options([
        'users_read' => 'View Users',
        'users_create' => 'Create Users',
        'users_edit' => 'Edit Users',
        'users_delete' => 'Delete Users',
        'content_read' => 'View Content',
        'content_create' => 'Create Content',
    ])
    ->icons([
        'users_read' => 'phosphor-eye',
        'users_create' => 'phosphor-user-plus',
        'users_edit' => 'phosphor-user-gear',
        'users_delete' => 'phosphor-user-minus',
        'content_read' => 'phosphor-article',
        'content_create' => 'phosphor-plus-circle',
    ])
    ->descriptions([
        'users_read' => 'List and view user profiles',
        'users_create' => 'Add new users to the system',
        'users_edit' => 'Modify existing user data',
        'users_delete' => 'Remove users from the system',
        'content_read' => 'Access and view all content',
        'content_create' => 'Create new posts and pages',
    ])
    ->extraTexts([
        'users_delete' => 'Caution',
        'content_create' => 'Popular',
    ])
    ->theme('minimal')
    ->columns(3)
    ->searchable()
    ->bulkToggleable();
```

### Application Settings

```php
RadioCards::make('app_theme')
    ->label('Application Theme')
    ->options([
        'light' => 'Light',
        'dark' => 'Dark',
        'auto' => 'Auto',
        'high_contrast' => 'High Contrast',
    ])
    ->icons([
        'light' => 'phosphor-sun',
        'dark' => 'phosphor-moon',
        'auto' => 'phosphor-circle-half',
        'high_contrast' => 'phosphor-eye',
    ])
    ->descriptions([
        'light' => 'Bright and clean interface',
        'dark' => 'Dark interface, ideal for low-light environments',
        'auto' => 'Follows system configuration',
        'high_contrast' => 'Maximum contrast for accessibility',
    ])
    ->columns(2)
    ->default('auto');
```

## 🛠️ Development

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

## 📝 Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## 🤝 Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](.github/CONTRIBUTING.md) for details.

**Development Setup:**

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new functionality
5. Ensure all tests pass
6. Submit a pull request

## 🔒 Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## 👥 Credits

- [Tone Gabes](https://github.com/tonegabes) - Creator and maintainer
- [All Contributors](../../contributors) - Thank you for your contributions!

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---

<p align="center">
  <strong>Made with ❤️ by <a href="https://tonegabes.com">Tone Gabes</a></strong>
</p>
