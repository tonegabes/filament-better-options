<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Services;

use BackedEnum;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Contracts\Support\Htmlable;
use ToneGabes\BetterOptions\Forms\IndicatorsIconAlias;
use ToneGabes\Filament\Icons\Enums\Phosphor;

class IconManagerService
{
    public static function resolveIndicatorIcon(?string $componentType, string $state): string|BackedEnum|Htmlable
    {
        return match ($componentType) {
            'checkbox' => match ($state) {
                'selected' => self::resolveIcon(
                    Phosphor::CheckSquareFill->getLabel(),
                    IndicatorsIconAlias::CHECKBOX_SELECTED
                ),
                default => self::resolveIcon(
                    Phosphor::SquareThin->getLabel(),
                    IndicatorsIconAlias::CHECKBOX_IDLE
                ),

            },
            'radio' => match ($state) {
                'selected' => self::resolveIcon(
                    Phosphor::CheckCircleFill->getLabel(),
                    IndicatorsIconAlias::RADIO_SELECTED
                ),
                default => self::resolveIcon(
                    Phosphor::CircleThin->getLabel(),
                    IndicatorsIconAlias::RADIO_IDLE
                ),
            },
            default => throw new \InvalidArgumentException("Unknown component type: {$componentType}"),
        };
    }

    public static function resolveIcon(string $icon, string $alias): string|BackedEnum|Htmlable
    {
        if (filled($alias)) {
            $icon = FilamentIcon::resolve($alias) ?: $icon;
        }

        if ($icon instanceof HasLabel) {
            return $icon->getLabel();
        }

        if ($icon instanceof BackedEnum) {
            return $icon->value;
        }

        return $icon;
    }
}
