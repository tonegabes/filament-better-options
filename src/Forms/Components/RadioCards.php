<?php

declare(strict_types=1);

namespace App\Filament\Components\Forms;

use App\Traits\HasExtraTexts;
use App\Traits\HasIndicator;
use App\Traits\HasOptionIcon;
use Closure;
use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts\CanDisableOptions;
use Filament\Forms\Components\Field;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Enums\IconPosition;

class RadioCards extends Field implements CanDisableOptions
{
    use Concerns\CanDisableOptions;
    use Concerns\CanDisableOptionsWhenSelectedInSiblingRepeaterItems;
    use Concerns\CanFixIndistinctState;
    use Concerns\HasDescriptions;
    use Concerns\HasExtraInputAttributes;
    use Concerns\HasGridDirection;
    use Concerns\HasOptions;
    use HasColumns;
    use HasExtraTexts;
    use HasIndicator;
    use HasOptionIcon;

    /**
     * @var view-string
     */
    protected string $view = 'filament.components.forms.radio-cards';

    protected bool | Closure $isDescriptionHidden = false;

    protected bool | Closure $isItemsCenter = false;

    public function defaultIconPosition(): IconPosition
    {
        return IconPosition::Before;
    }

    public function defaultIndicatorPosition(): IconPosition
    {
        return IconPosition::After;
    }

    public function isItemsCenter(): bool
    {
        return (bool) $this->evaluate($this->isItemsCenter);
    }

    public function itemsCenter(bool | Closure $condition = true): static
    {
        $this->isItemsCenter = $condition;

        return $this;
    }

    public function isDescriptionHidden(): bool
    {
        return (bool) $this->evaluate($this->isDescriptionHidden);
    }

    public function hiddenDescription(bool | Closure $condition = true): static
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
