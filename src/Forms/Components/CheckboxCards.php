<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use ToneGabes\BetterOptions\Support\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Support\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Support\Concerns\HasOptionIcon;
use BackedEnum;
use Closure;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;
use ToneGabes\Filament\Icons\Enums\Phosphor;

class CheckboxCards extends CheckboxList
{
    use HasColumns;
    use HasExtraTexts;
    use HasIndicator;
    use HasOptionIcon;

    protected bool | Closure $isItemsCenter = false;

    protected string $view = 'components.checkbox-cards';

    public function defaultIndicatorPosition(): IconPosition
    {
        return IconPosition::After;
    }

    public function defaultIconPosition(): IconPosition
    {
        return IconPosition::Before;
    }

    public function defaultIdleIndicator(): string | BackedEnum | Htmlable
    {
        return Phosphor::SquareThin->getLabel();
    }

    public function defaultSelectedIndicator(): string | BackedEnum | Htmlable
    {
        return Phosphor::CheckSquareFill->getLabel();
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
}
