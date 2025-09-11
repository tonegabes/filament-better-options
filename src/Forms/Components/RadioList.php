<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts\CanDisableOptions;
use Filament\Forms\Components\Field;
use Filament\Support\Enums\IconPosition;
use ToneGabes\BetterOptions\Concerns\HasBetterDescriptions;
use ToneGabes\BetterOptions\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Concerns\HasOptionIcon;

class RadioList extends Field implements CanDisableOptions
{
    use Concerns\CanDisableOptions;
    use Concerns\CanDisableOptionsWhenSelectedInSiblingRepeaterItems;
    use Concerns\CanFixIndistinctState;
    use Concerns\HasDescriptions;
    use Concerns\HasExtraInputAttributes;
    use Concerns\HasGridDirection;
    use Concerns\HasOptions;
    use HasBetterDescriptions;
    use HasExtraTexts;
    use HasIndicator;
    use HasOptionIcon;

    /**
     * @var view-string
     */
    protected string $view = 'better-options::components.radio-list';

    public function defaultIconPosition(): IconPosition
    {
        return IconPosition::After;
    }

    public function defaultIndicatorPosition(): IconPosition
    {
        return IconPosition::Before;
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
