<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;
use ToneGabes\BetterOptions\Forms\Components\CheckboxCards;

it('can be instantiated with the cards style', function (): void {
    $component = CheckboxCards::make('roles');

    $typeRef = new ReflectionProperty($component, 'componentType');
    $styleRef = new ReflectionProperty($component, 'componentStyle');

    expect($typeRef->getValue($component))->toBe(ComponentTypes::Checkbox);
    expect($styleRef->getValue($component))->toBe(ComponentStyles::Cards);
});

it('can center items', function (): void {
    $component = CheckboxCards::make('roles')->itemsCenter();

    expect($component->isItemsCenter())->toBeTrue();
});
