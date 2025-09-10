<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use BackedEnum;
use Filament\Forms\Components\CheckboxList as BaseCheckboxList;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;
use ToneGabes\BetterOptions\Support\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Support\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Support\Concerns\HasOptionIcon;
use ToneGabes\Filament\Icons\Enums\Phosphor;

class CheckboxList extends BaseCheckboxList
{
    use HasExtraTexts;
    use HasIndicator;
    use HasOptionIcon;

    protected string $view = 'better-options::components.checkbox-list';

    public function defaultIndicatorPosition(): IconPosition
    {
        return IconPosition::Before;
    }

    public function defaultIconPosition(): IconPosition
    {
        return IconPosition::After;
    }

    public function defaultIdleIndicator(): string|BackedEnum|Htmlable
    {
        return Phosphor::SquareThin->getLabel();
    }

    public function defaultSelectedIndicator(): string|BackedEnum|Htmlable
    {
        return Phosphor::CheckSquareFill->getLabel();
    }
}
