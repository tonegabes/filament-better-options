<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;
use ToneGabes\BetterOptions\Forms\Components\RadioStackedCards;

it('uses the stacked_cards style', function (): void {
    $component = RadioStackedCards::make('role');

    $typeRef = new ReflectionProperty($component, 'componentType');
    $styleRef = new ReflectionProperty($component, 'componentStyle');

    expect($typeRef->getValue($component))->toBe(ComponentTypes::Radio);
    expect($styleRef->getValue($component))->toBe(ComponentStyles::StackedCards);
});
