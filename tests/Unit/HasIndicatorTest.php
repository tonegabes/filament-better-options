<?php

declare(strict_types=1);

use Filament\Support\Enums\IconPosition;
use ToneGabes\BetterOptions\Forms\Components\CheckboxList;
use ToneGabes\BetterOptions\Forms\Components\RadioList;

it('defaults to indicator visible and not partially hidden', function (): void {
    $component = CheckboxList::make('roles');

    expect($component->isIndicatorVisible())->toBeTrue();
    expect($component->isIndicatorPartiallyHidden())->toBeFalse();
});

it('allows hiding the indicator', function (): void {
    $component = CheckboxList::make('roles')->hiddenIndicator();

    expect($component->isIndicatorVisible())->toBeFalse();
});

it('allows partially hiding the indicator', function (): void {
    $component = CheckboxList::make('roles')->partiallyHiddenIndicator();

    expect($component->isIndicatorPartiallyHidden())->toBeTrue();
});

it('applies explicit indicator position over config default', function (): void {
    $component = CheckboxList::make('roles')->indicatorAfter();

    expect($component->isIndicatorAfter())->toBeTrue()
        ->and($component->isIndicatorBefore())->toBeFalse();
});

it('reads the indicator position from config for each style', function (): void {
    $checkbox = CheckboxList::make('roles');
    $radio = RadioList::make('role');

    expect($checkbox->getDefaultIndicatorPosition())->toBe(IconPosition::Before);
    expect($radio->getDefaultIndicatorPosition())->toBe(IconPosition::Before);
});
