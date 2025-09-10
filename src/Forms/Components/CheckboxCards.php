<?php

declare(strict_types=1);

namespace App\Filament\Components\Forms;

use App\Traits\HasExtraTexts;
use App\Traits\HasIndicator;
use App\Traits\HasOptionIcon;
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

    protected string $view = 'filament.components.forms.checkbox-cards';

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
