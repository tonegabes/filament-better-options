<?php

namespace ToneGabes\FilamentBetterRadioAndCheckbox;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BetterOptionsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'better-options';

    public static string $viewNamespace = 'better-options';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name);

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            AlpineComponent::make('checkbox', __DIR__.'/../resources/js/checkbox.js')
                ->loadedOnRequest(),
            Css::make('better-options-styles', __DIR__.'/../resources/css/index.css'),
        ], 'tonegabes/filament-better-options');
    }
}
