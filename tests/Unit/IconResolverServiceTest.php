<?php

declare(strict_types=1);

use ToneGabes\BetterOptions\Services\IconResolverService;

it('returns a heroicon fallback by default for checkbox idle', function (): void {
    $icon = IconResolverService::default(IconResolverService::KEY_CHECKBOX_IDLE);

    if (! IconResolverService::isPhosphorAvailable()) {
        expect($icon)->toBe('heroicon-o-square-2-stack');
    } else {
        expect($icon)->not->toBeNull();
    }
});

it('respects config overrides', function (): void {
    config()->set('better-options.icons.defaults.checkbox_idle', 'heroicon-o-square');

    expect(IconResolverService::default(IconResolverService::KEY_CHECKBOX_IDLE))
        ->toBe('heroicon-o-square');
});

it('falls back to a generic heroicon for unknown keys', function (): void {
    $icon = IconResolverService::default('unknown_key');

    if (! IconResolverService::isPhosphorAvailable()) {
        expect($icon)->toBe('heroicon-o-question-mark-circle');
    } else {
        expect($icon)->not->toBeNull();
    }
});
