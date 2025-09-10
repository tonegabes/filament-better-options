# This is my package filament-better-radio-and-checkbox

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tonegabes/filament-better-radio-and-checkbox.svg?style=flat-square)](https://packagist.org/packages/tonegabes/filament-better-radio-and-checkbox)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tonegabes/filament-better-radio-and-checkbox/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tonegabes/filament-better-radio-and-checkbox/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/tonegabes/filament-better-radio-and-checkbox/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/tonegabes/filament-better-radio-and-checkbox/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/tonegabes/filament-better-radio-and-checkbox.svg?style=flat-square)](https://packagist.org/packages/tonegabes/filament-better-radio-and-checkbox)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require tonegabes/filament-better-radio-and-checkbox
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-better-radio-and-checkbox-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-better-radio-and-checkbox-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-better-radio-and-checkbox-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filamentBetterRadioAndCheckbox = new ToneGabes\FilamentBetterRadioAndCheckbox();
echo $filamentBetterRadioAndCheckbox->echoPhrase('Hello, ToneGabes!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tone Gabes](https://github.com/tonegabes)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
