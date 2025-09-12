<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use Filament\Forms\Components\CheckboxList as BaseCheckboxList;
use Filament\Support\Enums\IconPosition;
use ToneGabes\BetterOptions\Concerns\HasBetterDescriptions;
use ToneGabes\BetterOptions\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Concerns\HasOptionIcon;

class CheckboxList extends BaseCheckboxList
{
    use HasBetterDescriptions;
    use HasExtraTexts;
    use HasIndicator;
    use HasOptionIcon;

    protected string $view = 'better-options::components.checkbox-list';

    public function defaultIconPosition(): IconPosition
    {
        return IconPosition::After;
    }

    public function setComponentType(): void
    {
        $this->componentType = 'checkbox';
    }

    public function setComponentStyle(): void
    {
        $this->componentStyle = 'list';
    }
}
