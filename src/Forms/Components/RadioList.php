<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use Closure;
use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts\CanDisableOptions;
use Filament\Forms\Components\Field;
use Filament\Support\Enums\IconPosition;
use ToneGabes\BetterOptions\Support\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Support\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Support\Concerns\HasOptionIcon;

class RadioList extends Field implements CanDisableOptions
{
    use Concerns\CanDisableOptions;
    use Concerns\CanDisableOptionsWhenSelectedInSiblingRepeaterItems;
    use Concerns\CanFixIndistinctState;
    use Concerns\HasDescriptions;
    use Concerns\HasExtraInputAttributes;
    use Concerns\HasGridDirection;
    use Concerns\HasOptions;
    use HasExtraTexts;
    use HasIndicator;
    use HasOptionIcon;

    /**
     * @var view-string
     */
    protected string $view = 'better-options::components.radio-list';

    protected bool|Closure $isDescriptionHidden = false;

    protected bool|Closure $isItemsCenter = false;

    public function defaultIconPosition(): IconPosition
    {
        return IconPosition::After;
    }

    public function defaultIndicatorPosition(): IconPosition
    {
        return IconPosition::Before;
    }

    public function isItemsCenter(): bool
    {
        return (bool) $this->evaluate($this->isItemsCenter);
    }

    public function itemsCenter(bool|Closure $condition = true): static
    {
        $this->isItemsCenter = $condition;

        return $this;
    }

    public function isDescriptionHidden(): bool
    {
        return (bool) $this->evaluate($this->isDescriptionHidden);
    }

    public function hiddenDescription(bool|Closure $condition = true): static
    {
        $this->isDescriptionHidden = $condition;

        return $this;
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
