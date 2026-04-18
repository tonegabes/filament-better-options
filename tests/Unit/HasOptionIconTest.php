<?php

declare(strict_types=1);

use Filament\Support\Enums\IconPosition;
use ToneGabes\BetterOptions\Forms\Components\CheckboxCards;
use ToneGabes\BetterOptions\Forms\Components\CheckboxList;
use ToneGabes\BetterOptions\Tests\Fixtures\RolesEnum;

it('reads the icon position default for list style from config', function (): void {
    $component = CheckboxList::make('roles');

    expect($component->getDefaultIconPosition())->toBe(IconPosition::After);
});

it('reads the icon position default for cards style from config', function (): void {
    $component = CheckboxCards::make('roles');

    expect($component->getDefaultIconPosition())->toBe(IconPosition::Before);
});

it('exposes icons through hasIcon()/getIcon() when icons are registered', function (): void {
    $component = CheckboxList::make('roles')
        ->options([
            RolesEnum::Manager->value => RolesEnum::Manager->getLabel(),
            RolesEnum::Editor->value  => RolesEnum::Editor->getLabel(),
        ])
        ->icons([
            RolesEnum::Manager->value => RolesEnum::Manager->getIcon(),
            RolesEnum::Editor->value  => RolesEnum::Editor->getIcon(),
        ]);

    expect($component->hasIcon(RolesEnum::Manager->value))->toBeTrue();
    expect($component->getIcon(RolesEnum::Editor->value))->toBe('heroicon-o-pencil');
});

it('can hide option icons via hiddenIcon()', function (): void {
    $component = CheckboxList::make('roles')->hiddenIcon();

    expect($component->isIconVisible())->toBeFalse();
});
