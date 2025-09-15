<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts\CanDisableOptions;
use Filament\Forms\Components\Field;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Concerns\HasExtraAttributes;
use ToneGabes\BetterOptions\Concerns\HasBetterDescriptions;
use ToneGabes\BetterOptions\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Concerns\HasItemsCenter;
use ToneGabes\BetterOptions\Concerns\HasOptionIcon;
use ToneGabes\BetterOptions\Enums\ComponentTypes;
use ToneGabes\BetterOptions\Enums\ComponentStyles;

class RadioCards extends Field implements CanDisableOptions
{
    use Concerns\CanDisableOptions;
    use Concerns\CanDisableOptionsWhenSelectedInSiblingRepeaterItems;
    use Concerns\CanFixIndistinctState;
    use Concerns\HasDescriptions;
    use Concerns\HasExtraInputAttributes;
    use Concerns\HasGridDirection;
    use Concerns\HasOptions;
    use HasBetterDescriptions;
    use HasColumns;
    use HasExtraAttributes;
    use HasExtraTexts;
    use HasIndicator;
    use HasItemsCenter;
    use HasOptionIcon;

    protected string $view = 'better-options::components.radio.cards';

    protected function setUp(): void
    {
        parent::setUp();

        $this->setComponentType(ComponentTypes::Radio);
        $this->setComponentStyle(ComponentStyles::Cards);
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

    /**
     * @return ?array<string>
     */
    public function getInValidationRuleValues(): ?array
    {
        $values = parent::getInValidationRuleValues();

        if ($values !== null) {
            return $values;
        }

        return array_keys($this->getEnabledOptions());
    }
}
