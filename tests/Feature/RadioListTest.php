<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;
use ToneGabes\BetterOptions\Forms\Components\RadioList;

it('extends Filament native Radio for API parity', function (): void {
    $component = RadioList::make('role');

    expect($component)->toBeInstanceOf(Filament\Forms\Components\Radio::class);
});

it('uses the list style', function (): void {
    $component = RadioList::make('role');

    $typeRef = new ReflectionProperty($component, 'componentType');
    $styleRef = new ReflectionProperty($component, 'componentStyle');

    expect($typeRef->getValue($component))->toBe(ComponentTypes::Radio);
    expect($styleRef->getValue($component))->toBe(ComponentStyles::List);
});
