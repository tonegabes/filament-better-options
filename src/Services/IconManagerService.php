<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Services;

use BackedEnum;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Contracts\Support\Htmlable;
use InvalidArgumentException;
use ToneGabes\BetterOptions\Enums\ComponentTypes;
use ToneGabes\BetterOptions\Forms\IndicatorsIconAlias;

class IconManagerService
{
    /**
     * Resolve the default idle or selected indicator icon for the given component type.
     *
     * @param  'idle'|'selected'  $state
     */
    public static function resolveIndicatorIcon(?ComponentTypes $componentType, string $state): string|BackedEnum|Htmlable
    {
        if ($componentType === null) {
            throw new InvalidArgumentException(
                'Cannot resolve an indicator icon because the component type was not set. Did you forget to call setComponentType()?'
            );
        }

        [$fallbackKey, $alias] = self::mapTypeAndState($componentType, $state);

        $default = IconResolverService::default($fallbackKey);

        return self::resolveIcon($default, $alias);
    }

    /**
     * Resolve an icon value through the Filament icon alias system.
     *
     * The caller provides a sensible default (string, BackedEnum or Htmlable); when the alias
     * is registered via `FilamentIcon::register()` the registered value wins.
     */
    public static function resolveIcon(string|BackedEnum|Htmlable $icon, string $alias): string|BackedEnum|Htmlable
    {
        if (filled($alias)) {
            $resolved = FilamentIcon::resolve($alias);

            if (filled($resolved)) {
                $icon = $resolved;
            }
        }

        if ($icon instanceof BackedEnum && $icon instanceof HasLabel) {
            return $icon->getLabel();
        }

        if ($icon instanceof BackedEnum) {
            return (string) $icon->value;
        }

        return $icon;
    }

    /**
     * Map a component type + state pair to a resolver key and a Filament icon alias.
     *
     * @param  'idle'|'selected'  $state
     * @return array{0: string, 1: string}
     */
    protected static function mapTypeAndState(ComponentTypes $componentType, string $state): array
    {
        return match (true) {
            $componentType === ComponentTypes::Checkbox && $state === 'selected' => [
                IconResolverService::KEY_CHECKBOX_SELECTED,
                IndicatorsIconAlias::CHECKBOX_SELECTED,
            ],
            $componentType === ComponentTypes::Checkbox => [
                IconResolverService::KEY_CHECKBOX_IDLE,
                IndicatorsIconAlias::CHECKBOX_IDLE,
            ],
            $componentType === ComponentTypes::Radio && $state === 'selected' => [
                IconResolverService::KEY_RADIO_SELECTED,
                IndicatorsIconAlias::RADIO_SELECTED,
            ],
            default => [
                IconResolverService::KEY_RADIO_IDLE,
                IndicatorsIconAlias::RADIO_IDLE,
            ],
        };
    }
}
