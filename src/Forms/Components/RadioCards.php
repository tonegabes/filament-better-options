<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use Filament\Forms\Components\Radio as BaseRadio;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Concerns\HasExtraAttributes;
use ToneGabes\BetterOptions\Concerns\HasBetterDescriptions;
use ToneGabes\BetterOptions\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Concerns\HasItemsCenter;
use ToneGabes\BetterOptions\Concerns\HasOptionColor;
use ToneGabes\BetterOptions\Concerns\HasOptionIcon;
use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;

/**
 * Enhanced radio rendered as a grid of cards, with optional icons,
 * indicators, descriptions and extra texts.
 */
class RadioCards extends BaseRadio
{
    use HasBetterDescriptions;
    use HasColumns;
    use HasExtraAttributes;
    use HasExtraTexts;
    use HasIndicator;
    use HasItemsCenter;
    use HasOptionColor;
    use HasOptionIcon;

    protected string $view = 'better-options::components.radio.cards';

    protected function setUp(): void
    {
        parent::setUp();

        $this->setComponentType(ComponentTypes::Radio);
        $this->setComponentStyle(ComponentStyles::Cards);
    }

    /**
     * Apply a pre-defined theme configuration.
     *
     * Supported themes: `minimal`, `modern`, `classic`.
     */
    public function theme(string $theme): static
    {
        return match ($theme) {
            'minimal' => $this->applyMinimalTheme(),
            'modern'  => $this->applyModernTheme(),
            'classic' => $this->applyClassicTheme(),
            default   => $this,
        };
    }

    /**
     * Apply the minimal theme: subtle indicator with icon after and indicator before.
     */
    protected function applyMinimalTheme(): static
    {
        return $this
            ->partiallyHiddenIndicator()
            ->iconAfter()
            ->indicatorBefore();
    }

    /**
     * Apply the modern theme: icon before content, indicator after, items centered.
     */
    protected function applyModernTheme(): static
    {
        return $this
            ->iconBefore()
            ->indicatorAfter()
            ->itemsCenter();
    }

    /**
     * Apply the classic theme: traditional layout with icon after and indicator before.
     */
    protected function applyClassicTheme(): static
    {
        return $this
            ->iconAfter()
            ->indicatorBefore();
    }
}
