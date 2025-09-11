<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts\CanDisableOptions;
use Filament\Forms\Components\Field;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Concerns\HasExtraAttributes;
use Filament\Support\Enums\IconPosition;
use ToneGabes\BetterOptions\Concerns\HasBetterDescriptions;
use ToneGabes\BetterOptions\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Concerns\HasItemsCenter;
use ToneGabes\BetterOptions\Concerns\HasOptionIcon;

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

    /**
     * @var view-string
     */
    protected string $view = 'better-options::components.radio-cards';

    public function defaultIconPosition(): IconPosition
    {
        return IconPosition::Before;
    }

    public function defaultIndicatorPosition(): IconPosition
    {
        return IconPosition::After;
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
