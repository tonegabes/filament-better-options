# Filament Better Options

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tonegabes/filament-better-options.svg?style=flat-square)](https://packagist.org/packages/tonegabes/filament-better-options)
[![Total Downloads](https://img.shields.io/packagist/dt/tonegabes/filament-better-options.svg?style=flat-square)](https://packagist.org/packages/tonegabes/filament-better-options)

Enhanced form components for Filament Forms with modern interface, advanced features, and excellent performance. Provides `CheckboxList`, `CheckboxCards`, `RadioList`, and `RadioCards` with icons, visual indicators, descriptions, extra texts, search functionality, and bulk operations.

## Features

✨ **Enhanced UI Components**

- Modern card-based and list layouts
- Extensible icon system using Filament icons aliases
- Flexible icon positioning (before/after)
- Support for descriptions and extra texts
- Pre-defined themes (minimal, modern, classic)

### Advanced Features
- Real-time search with debounced input
- Bulk select/deselect operations for checkboxes
- Configurable positioning and visibility
- Performance-optimized JavaScript

🎨 **Extensible Architecture**

- Tailwind CSS styling with dark mode support
- Configurable default positions and icons via config file
- Full accessibility support

### Performance & Caching
- Intelligent icon caching system
- Efficient DOM operations and caching
- Alpine.js components loaded on demand
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

Optionally, publish the configuration file for positioning settings:

```bash
php artisan vendor:publish --tag="better-options-config"
```

Optionally, publish the assets for customization:

```bash
php artisan vendor:publish --tag="better-options-assets"
```

## Configuration

The published configuration file (`config/better-options.php`) provides customization positioning options:

```php
return [
    'components' => [
        'checkbox' => [
            'list' => [
                'icon_position'      => 'after',
                'indicator_position' => 'before',
            ],
            'cards' => [
                'icon_position'      => 'before',
                'indicator_position' => 'after',
            ],
        ],
        'radio' => [
            'list' => [
                'icon_position'      => 'after',
                'indicator_position' => 'before',
            ],
            'cards' => [
                'icon_position'      => 'before',
                'indicator_position' => 'after',
            ],
        ],
    ],
];
```

## Usage

### Basic Examples

![Checkbox Cards Demo](https://raw.githubusercontent.com/tonegabes/filament-better-options/refs/heads/main/images/checkbox_cards.jpg)

```php
use ToneGabes\BetterOptions\Forms\Components\CheckboxCards;
use ToneGabes\Filament\Icons\Enums\Phosphor;

// Checkbox Cards with default features
CheckboxCards::make('permissions')
    ->label('Permissions')
    ->columns(2)
    ->options([
        'view'   => 'View',
        'edit'   => 'Edit',
        'delete' => 'Delete',
        'create' => 'Create',
    ])
    ->descriptions([
        'view'   => 'Allows viewing the model.',
        'edit'   => 'Allows editing the model.',
        'delete' => 'Allows deleting the model.',
        'create' => 'Allows creating a new model.',
    ])
    ->icons([
        'view'   => Phosphor::Eye->thin(),
        'edit'   => Phosphor::Pencil->thin(),
        'delete' => Phosphor::Trash->thin(),
        'create' => Phosphor::Plus->thin(),
    ])
,
```

![Checkbox List Demo](https://raw.githubusercontent.com/tonegabes/filament-better-options/refs/heads/main/images/checkbox_list.jpg)

```php
use ToneGabes\BetterOptions\Forms\Components\CheckboxList;
use ToneGabes\Filament\Icons\Enums\Phosphor;

// Checkbox List with default features
CheckboxList::make('permissions')
    ->label('Permissions')
    ->options([
        'view'   => 'View',
        'edit'   => 'Edit',
        'delete' => 'Delete',
        'create' => 'Create',
    ])
    ->descriptions([
        'view'   => 'Allows viewing the model.',
        'edit'   => 'Allows editing the model.',
        'delete' => 'Allows deleting the model.',
        'create' => 'Allows creating a new model.',
    ])
    ->icons([
        'view'   => Phosphor::Eye->thin(),
        'edit'   => Phosphor::Pencil->thin(),
        'delete' => Phosphor::Trash->thin(),
        'create' => Phosphor::Plus->thin(),
    ])
,
```

![Radio Cards Demo](https://raw.githubusercontent.com/tonegabes/filament-better-options/refs/heads/main/images/radio_cards.jpg)

```php
use ToneGabes\BetterOptions\Forms\Components\RadioCards;
use ToneGabes\Filament\Icons\Enums\Phosphor;

// Radio Cards with default features
RadioCards::make('role')
    ->label('Role')
    ->columns(2)
    ->options([
        'manager' => 'Manager',
        'editor'  => 'Editor',
        'viewer'  => 'Viewer',
        'creator' => 'Creator',
    ])
    ->descriptions([
        'manager' => 'Allows managing the model.',
        'editor'  => 'Allows editing the model.',
        'viewer'  => 'Allows viewing the model.',
        'creator' => 'Allows creating a new model.',
    ])
    ->icons([
        'manager' => Phosphor::Gear->thin(),
        'editor'  => Phosphor::Pencil->thin(),
        'viewer'  => Phosphor::Eye->thin(),
        'creator' => Phosphor::Plus->thin(),
    ])
,
```

![Radio List Demo](https://raw.githubusercontent.com/tonegabes/filament-better-options/refs/heads/main/images/radio_list.jpg)

```php
use ToneGabes\BetterOptions\Forms\Components\RadioList;
use ToneGabes\Filament\Icons\Enums\Phosphor;

// Radio List with default features
RadioList::make('role')
    ->label('Role')
    ->options([
        'manager' => 'Manager',
        'editor'  => 'Editor',
        'viewer'  => 'Viewer',
        'creator' => 'Creator',
    ])
    ->descriptions([
        'manager' => 'Allows managing the model.',
        'editor'  => 'Allows editing the model.',
        'viewer'  => 'Allows viewing the model.',
        'creator' => 'Allows creating a new model.',
    ])
    ->icons([
        'manager' => Phosphor::Gear->thin(),
        'editor'  => Phosphor::Pencil->thin(),
        'viewer'  => Phosphor::Eye->thin(),
        'creator' => Phosphor::Plus->thin(),
    ])
,
```

## Using Enums

This package provides a convenient way to use PHP enums for defining options, descriptions, and icons. Here's how you can leverage enums in your component definitions:

```php
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use ToneGabes\BetterOptions\Contracts\HasExtraText;
use ToneGabes\Filament\Icons\Enums\Phosphor;

enum Roles: string implements HasDescription, HasExtraText, HasIcon, HasLabel {
    case Manager = 'manager';
    case Editor = 'editor';
    case Viewer = 'viewer';
    case Creator = 'creator';

    public function getDescription(): string {
        return match($this) {
            self::Manager => 'Allows managing the model.',
            self::Editor  => 'Allows editing the model.',
            self::Viewer  => 'Allows viewing the model.',
            self::Creator => 'Allows creating a new model.',
        };
    }

    public function getExtraText(): string {
        return match($this) {
            self::Manager => 'model.manager',
            self::Editor  => 'model.editor',
            self::Viewer  => 'model.viewer',
            self::Creator => 'model.creator',
        };
    }

    public function getIcon(): string {
        return match($this) {
            self::Manager => Phosphor::Gear->thin(),
            self::Editor  => Phosphor::Pencil->thin(),
            self::Viewer  => Phosphor::Eye->thin(),
            self::Creator => Phosphor::Plus->thin(),
        };
    }

    public function getLabel(): string {
        return match($this) {
            self::Manager => 'Manager',
            self::Editor  => 'Editor',
            self::Viewer  => 'Viewer',
            self::Creator => 'Creator',
        };
    }
}
```

Passing a Backend Enum automatically maps the enum cases to the component options, descriptions, icons, and extra texts.

```php
RadioList::make('role')
    ->label('Role')
    ->enum(Roles::cases())

    //  No need to specify these if enum is using filament enum contracts
    // ->descriptions()
    // ->icons()
    // ->extraTexts()
,
```

You can hide the descriptions, icons, and extra texts if you don't need them.

```php
RadioList::make('role')
    ->enum(Roles::class)
    ->hiddenDescriptions()
    ->hiddenIcons()
    ->hiddenExtraTexts()
,

// Accepts Closures
RadioList::make('role')
    ->enum(Roles::class)
    ->hiddenDescription(fn () => false)
    ->hiddenIcon(fn () => false)
    ->hiddenExtraText(fn () => false)
,
```

### Advanced Features

#### Search and Bulk Operations

```php
CheckboxList::make('permissions')
    ->label('Permissions')
    ->enum(Permissions::class)
    ->searchable()
    ->searchPrompt('Search permissions...')
    ->bulkToggleable()
,
```

![Radio List Demo](https://raw.githubusercontent.com/tonegabes/filament-better-options/refs/heads/main/images/checkbox_list_search_bulk.jpg)

#### Custom Positioning and Visibility

```php
RadioCards::make('role')
    ->label('Role')
    ->columns(2)
    ->enum(Roles::class)
    ->partiallyHiddenIndicator()
    ->itemsCenter()
    ->iconAfter()
    ->indicatorBefore()

    // ->hiddenIndicator() // You also can totaly hide the indicator
,
```

![Radio Cards Demo](https://raw.githubusercontent.com/tonegabes/filament-better-options/refs/heads/main/images/radio_cards_positioning.jpg)

#### Icons and Indicators

```php
RadioList::make('role')
    ->label('Role')
    ->enum(Roles::class)
    ->idleIndicator(Phosphor::User->thin())
    ->selectedIndicator(Phosphor::User->fill())
,
```

![Radio List Indicators Demo](https://raw.githubusercontent.com/tonegabes/filament-better-options/refs/heads/main/images/radio_list_indicators.jpg)

#### Extra Texts/Values

```php
CheckboxCards::make('permissions')
    ->label('Permissions')
    ->columns(2)
    ->enum(Permissions::class)
    ->extraTexts([
        'view'   => 'model.view',
        'edit'   => 'model.edit',
        'delete' => 'model.delete',
        'create' => 'model.create',
    ])
,
```

![Checkbox Cards Extratexts Demo](https://raw.githubusercontent.com/tonegabes/filament-better-options/refs/heads/main/images/checkbox_cards_extratexts.jpg)

```php
RadioCard::make('storage')
    ->enum(Storages::class)
    ->hiddenIcon()
    ->partiallyHiddenIndicator()
    ->idleIndicator(Phosphor::HardDrives->thin())
    ->selectedIndicator(Phosphor::HardDrives->fill())
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



## Available Components

| Component        | Description                      | Features                                           |
| ---------------- | -------------------------------- | -------------------------------------------------- |
| `CheckboxList`   | Vertical list of checkboxes      | Search, Bulk toggle, Icons                        |
| `CheckboxCards`  | Grid of checkbox cards           | All list features + Columns, Centering            |
| `RadioList`      | Vertical list of radio buttons   | Icons, Custom indicators                           |
| `RadioCards`     | Grid of radio button cards       | All list features + Columns, Centering            |

## Component Methods

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
```

## Styling and Themes

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
.is-indicator-partially-hidden
```

## Credits

- [Tone Gabes](https://github.com/tonegabes)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---

<p align="center">
  <strong>Made with ❤️ by <a href="https://tonegabes.com">Tone Gabes</a></strong>
</p>
