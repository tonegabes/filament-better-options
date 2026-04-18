<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Forms\Components\CheckboxList;
use ToneGabes\BetterOptions\Tests\Fixtures\RolesEnum;

it('returns extra texts from explicit array', function (): void {
    $component = CheckboxList::make('roles')->extraTexts([
        'a' => 'Extra A',
        'b' => 'Extra B',
    ]);

    expect($component->hasExtraText('a'))->toBeTrue();
    expect($component->getExtraText('b'))->toBe('Extra B');
});

it('falls back to enum HasExtraText contract', function (): void {
    $component = CheckboxList::make('roles')->options(RolesEnum::class);

    expect($component->hasExtraText(RolesEnum::Manager->value))->toBeTrue();
    expect($component->getExtraText(RolesEnum::Editor->value))->toBe('extra.editor');
});

it('can hide extra texts via hiddenExtraText()', function (): void {
    $component = CheckboxList::make('roles')->hiddenExtraText();

    expect($component->isExtraTextVisible())->toBeFalse();
});
