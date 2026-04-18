<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;
use ToneGabes\BetterOptions\Forms\Components\RadioTable;

it('uses the table style', function (): void {
    $component = RadioTable::make('role');

    $typeRef = new ReflectionProperty($component, 'componentType');
    $styleRef = new ReflectionProperty($component, 'componentStyle');

    expect($typeRef->getValue($component))->toBe(ComponentTypes::Radio);
    expect($styleRef->getValue($component))->toBe(ComponentStyles::Table);
});
