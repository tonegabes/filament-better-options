<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Enums\IconPosition;
use ToneGabes\BetterOptions\Concerns\HasBetterDescriptions;
use ToneGabes\BetterOptions\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Concerns\HasItemsCenter;
use ToneGabes\BetterOptions\Concerns\HasOptionIcon;

class CheckboxCards extends CheckboxList
{
    use HasBetterDescriptions;
    use HasColumns;
    use HasExtraTexts;
    use HasIndicator;
    use HasItemsCenter;
    use HasOptionIcon;

    protected string $view = 'better-options::components.checkbox-cards';

    public function defaultIconPosition(): IconPosition
    {
        $configPosition = config('better-options.default_positions.checkbox_cards.icon', 'before');

        return $configPosition === 'after' ? IconPosition::After : IconPosition::Before;
    }

    public function setComponentType(): void
    {
        $this->componentType = 'checkbox';
    }

    public function setComponentStyle(): void
    {
        $this->componentStyle = 'cards';
    }

    /**
     * Aplicar configuração de tema pré-definido
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
     * Aplicar tema minimal
     */
    protected function applyMinimalTheme(): static
    {
        return $this
            ->partiallyHiddenIndicator()
            ->iconAfter()
            ->indicatorBefore();
    }

    /**
     * Aplicar tema modern
     */
    protected function applyModernTheme(): static
    {
        return $this
            ->iconBefore()
            ->indicatorAfter()
            ->itemsCenter();
    }

    /**
     * Aplicar tema classic
     */
    protected function applyClassicTheme(): static
    {
        return $this
            ->iconAfter()
            ->indicatorBefore();
    }
}
