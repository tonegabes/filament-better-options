<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Concerns;

use Closure;
use Filament\Support\Contracts\HasColor;

use function Filament\Support\get_color_css_variables;

/**
 * Provides per-option color support.
 *
 * Resolution order for the color of an option value:
 *   1. A closure/array passed via `optionColors()`.
 *   2. `getColor()` on the enum case when the associated enum implements
 *      `Filament\Support\Contracts\HasColor`.
 *   3. The component-level color set via `color()` (from Filament's `HasColor` trait).
 *   4. `primary` fallback.
 */
trait HasOptionColor
{
    /**
     * @var array<array-key, string|array<int, string>>|Closure|null
     */
    protected array|Closure|null $optionColors = null;

    /**
     * @param  array<array-key, string|array<int, string>>|Closure|null  $colors
     */
    public function optionColors(array|Closure|null $colors): static
    {
        $this->optionColors = $colors;

        return $this;
    }

    /**
     * Return the color (Filament color name or palette array) for a given option value.
     *
     * @return string|array<int, string>|null
     */
    public function getOptionColor(mixed $value): string|array|null
    {
        $colors = $this->evaluate($this->optionColors);

        if (is_array($colors) && array_key_exists((string) $value, $colors)) {
            return $colors[(string) $value];
        }

        $enum = $this->getEnum();

        if (filled($enum) && is_a($enum, HasColor::class, allow_string: true)) {
            /** @var class-string<\BackedEnum> $enum */
            $case = null;

            foreach ($enum::cases() as $enumCase) {
                if (($enumCase->value ?? $enumCase->name) === $value) {
                    $case = $enumCase;
                    break;
                }
            }

            if ($case instanceof HasColor) {
                /** @var string|array<int, string>|null $color */
                $color = $case->getColor();

                if (filled($color)) {
                    return $color;
                }
            }
        }

        if (method_exists($this, 'getColor')) {
            /** @var string|array<int, string>|null $color */
            $color = $this->getColor();

            if (filled($color)) {
                return $color;
            }
        }

        return 'primary';
    }

    /**
     * Return inline CSS variables for the resolved color, ready to be placed in a `style` attribute.
     */
    public function getOptionColorStyles(string|array|null $color): string
    {
        if (blank($color)) {
            return '';
        }

        return get_color_css_variables($color, shades: [50, 100, 400, 500, 600, 700, 800]);
    }
}
