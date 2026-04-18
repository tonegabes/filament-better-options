<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;
use ToneGabes\BetterOptions\Forms\Components\CheckboxTable;

it('uses the table style', function (): void {
    $component = CheckboxTable::make('roles');

    $typeRef = new ReflectionProperty($component, 'componentType');
    $styleRef = new ReflectionProperty($component, 'componentStyle');

    expect($typeRef->getValue($component))->toBe(ComponentTypes::Checkbox);
    expect($styleRef->getValue($component))->toBe(ComponentStyles::Table);
});
