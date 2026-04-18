<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;
use ToneGabes\BetterOptions\Forms\Components\RadioCards;

it('uses the cards style', function (): void {
    $component = RadioCards::make('role');

    $typeRef = new ReflectionProperty($component, 'componentType');
    $styleRef = new ReflectionProperty($component, 'componentStyle');

    expect($typeRef->getValue($component))->toBe(ComponentTypes::Radio);
    expect($styleRef->getValue($component))->toBe(ComponentStyles::Cards);
});

it('exposes the theme method', function (): void {
    $component = RadioCards::make('role')->theme('minimal');

    expect($component)->toBeInstanceOf(RadioCards::class);
});
