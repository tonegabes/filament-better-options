<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Forms\Components\CheckboxList;
use ToneGabes\BetterOptions\Tests\Fixtures\RolesEnum;

it('falls back to primary color when no source is provided', function (): void {
    $component = CheckboxList::make('roles');

    expect($component->getOptionColor('anything'))->toBe('primary');
});

it('reads colors from an explicit optionColors() array', function (): void {
    $component = CheckboxList::make('roles')->optionColors([
        'a' => 'danger',
        'b' => 'success',
    ]);

    expect($component->getOptionColor('a'))->toBe('danger');
    expect($component->getOptionColor('b'))->toBe('success');
    expect($component->getOptionColor('missing'))->toBe('primary');
});

it('reads colors from an enum that implements HasColor', function (): void {
    $component = CheckboxList::make('roles')->options(RolesEnum::class);

    expect($component->getOptionColor(RolesEnum::Manager->value))->toBe('danger');
    expect($component->getOptionColor(RolesEnum::Creator->value))->toBe('success');
});
