<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;
use ToneGabes\BetterOptions\Forms\Components\CheckboxList;
use ToneGabes\BetterOptions\Tests\Fixtures\RolesEnum;

it('can be instantiated', function (): void {
    $component = CheckboxList::make('roles');

    expect($component)->toBeInstanceOf(CheckboxList::class);
    expect($component->getName())->toBe('roles');
});

it('reads options from a backed enum', function (): void {
    $component = CheckboxList::make('roles')->options(RolesEnum::class);

    expect($component->getOptions())->toHaveCount(count(RolesEnum::cases()));
});

it('applies default component type and style to support config resolution', function (): void {
    $component = CheckboxList::make('roles');

    $ref = new ReflectionProperty($component, 'componentType');
    expect($ref->getValue($component))->toBe(ComponentTypes::Checkbox);

    $ref = new ReflectionProperty($component, 'componentStyle');
    expect($ref->getValue($component))->toBe(ComponentStyles::List);
});
