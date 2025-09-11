<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BetterOptionsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'better-options';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews(static::$name)
            ->hasAssets()
            ->hasConfigFile(static::$name);
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            AlpineComponent::make(
                'better-checkbox',
                __DIR__ . '/../resources/js/better-checkbox.js',
            )->loadedOnRequest(),

            Css::make('better-options', __DIR__ . '/../resources/dist/better-options.css'),
        ], 'tonegabes/better-options');
    }
}
