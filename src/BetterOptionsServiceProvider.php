<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Config;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ToneGabes\BetterOptions\Contracts\IconProvider;
use ToneGabes\BetterOptions\Providers\PhosphorIconsProvider;
use ToneGabes\BetterOptions\Services\IconManager;

class BetterOptionsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'better-options';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews(static::$name)
            ->hasConfigFile(static::$name)
            ->hasAssets();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(IconManager::class, function () {
            $providerClass = Config::string(
                'better-options.icons_provider',
                PhosphorIconsProvider::class
            );

            /** @var IconProvider $provider */
            $provider = app($providerClass);

            return new IconManager($provider);
        });

        $this->app->alias(IconManager::class, 'better-options.icon-manager');
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            AlpineComponent::make(
                'better-checkbox',
                __DIR__ . '/../resources/js/better-checkbox.js',
            )->loadedOnRequest(),

            Css::make(
                'better-options',
                __DIR__ . '/../resources/dist/better-options.css',
            ),
        ], 'tonegabes/better-options');
    }
}
