<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use BackedEnum;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;
use ToneGabes\BetterOptions\Concerns\HasBetterDescriptions;
use ToneGabes\BetterOptions\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Concerns\HasItemsCenter;
use ToneGabes\BetterOptions\Concerns\HasOptionIcon;
use ToneGabes\Filament\Icons\Enums\Phosphor;

class CheckboxCards extends CheckboxList
{
    use HasBetterDescriptions;
    use HasColumns;
    use HasExtraTexts;
    use HasIndicator;
    use HasItemsCenter;
    use HasOptionIcon;

    protected string $view = 'better-options::components.checkbox-cards';

    public function defaultIndicatorPosition(): IconPosition
    {
        return IconPosition::After;
    }

    public function defaultIconPosition(): IconPosition
    {
        return IconPosition::Before;
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
