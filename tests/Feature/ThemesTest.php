<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Forms\Components\CheckboxCards;
use ToneGabes\BetterOptions\Forms\Components\RadioCards;

it('applies the minimal theme', function (): void {
    $component = CheckboxCards::make('roles')->theme('minimal');

    expect($component->isIndicatorPartiallyHidden())->toBeTrue();
    expect($component->isIconAfter())->toBeTrue();
    expect($component->isIndicatorBefore())->toBeTrue();
});

it('applies the modern theme', function (): void {
    $component = CheckboxCards::make('roles')->theme('modern');

    expect($component->isIconBefore())->toBeTrue();
    expect($component->isIndicatorAfter())->toBeTrue();
    expect($component->isItemsCenter())->toBeTrue();
});

it('applies the classic theme', function (): void {
    $component = CheckboxCards::make('roles')->theme('classic');

    expect($component->isIconAfter())->toBeTrue();
    expect($component->isIndicatorBefore())->toBeTrue();
});

it('is a no-op when an unknown theme is provided', function (): void {
    $component = RadioCards::make('role')->theme('doesNotExist');

    expect($component)->toBeInstanceOf(RadioCards::class);
});
