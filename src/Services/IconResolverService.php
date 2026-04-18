<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Services;

use BackedEnum;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Config;

/**
 * Resolves default indicator icons for the package.
 *
 * When `tonegabes/filament-phosphor-icons` is installed, Phosphor icons are
 * used as defaults. Otherwise, Heroicons aliases are used as a fallback so
 * the package works without extra dependencies.
 *
 * Defaults can be overridden via `config('better-options.icons.defaults')`.
 */
class IconResolverService
{
    public const KEY_CHECKBOX_IDLE = 'checkbox_idle';

    public const KEY_CHECKBOX_SELECTED = 'checkbox_selected';

    public const KEY_RADIO_IDLE = 'radio_idle';

    public const KEY_RADIO_SELECTED = 'radio_selected';

    /**
     * Resolve a default icon for a given key.
     *
     * Resolution order:
     *  1. User config under `better-options.icons.defaults.{key}`.
     *  2. Phosphor icon, when the Phosphor package is installed.
     *  3. Heroicons fallback.
     */
    public static function default(string $key): string|BackedEnum|Htmlable
    {
        $override = Config::get('better-options.icons.defaults.' . $key);

        if (filled($override)) {
            return self::normalize($override);
        }

        if (self::isPhosphorAvailable()) {
            return self::normalize(self::phosphorDefault($key));
        }

        return self::heroiconDefault($key);
    }

    /**
     * Whether the optional Phosphor icons package is installed.
     */
    public static function isPhosphorAvailable(): bool
    {
        return enum_exists('ToneGabes\\Filament\\Icons\\Enums\\Phosphor');
    }

    /**
     * Build a Phosphor enum case by its name (e.g. "SquareThin").
     *
     * Returns the enum instance when available, otherwise the Heroicon
     * fallback string.
     */
    protected static function phosphorDefault(string $key): string|BackedEnum
    {
        $map = [
            self::KEY_CHECKBOX_IDLE     => 'SquareThin',
            self::KEY_CHECKBOX_SELECTED => 'CheckSquareFill',
            self::KEY_RADIO_IDLE        => 'CircleThin',
            self::KEY_RADIO_SELECTED    => 'CheckCircleFill',
        ];

        $enumFqcn = 'ToneGabes\\Filament\\Icons\\Enums\\Phosphor';

        if (! enum_exists($enumFqcn)) {
            return self::heroiconDefault($key);
        }

        $caseName = $map[$key] ?? null;

        if ($caseName === null) {
            return self::heroiconDefault($key);
        }

        /** @var class-string<BackedEnum> $enumFqcn */
        foreach ($enumFqcn::cases() as $case) {
            if ($case->name === $caseName) {
                return $case;
            }
        }

        return self::heroiconDefault($key);
    }

    /**
     * Heroicons-based fallback defaults.
     */
    protected static function heroiconDefault(string $key): string
    {
        return match ($key) {
            self::KEY_CHECKBOX_IDLE     => 'heroicon-o-square-2-stack',
            self::KEY_CHECKBOX_SELECTED => 'heroicon-s-check-circle',
            self::KEY_RADIO_IDLE        => 'heroicon-o-circle',
            self::KEY_RADIO_SELECTED    => 'heroicon-s-check-circle',
            default                     => 'heroicon-o-question-mark-circle',
        };
    }

    /**
     * Normalize an icon value into a string|BackedEnum|Htmlable consumable by Blade.
     */
    protected static function normalize(mixed $icon): string|BackedEnum|Htmlable
    {
        if ($icon instanceof HasLabel && $icon instanceof BackedEnum) {
            return $icon;
        }

        if ($icon instanceof BackedEnum) {
            return $icon;
        }

        if ($icon instanceof Htmlable) {
            return $icon;
        }

        return (string) $icon;
    }
}
