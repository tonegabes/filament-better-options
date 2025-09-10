<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use BackedEnum;
use Closure;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;
use ToneGabes\BetterOptions\Support\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Support\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Support\Concerns\HasOptionIcon;
use ToneGabes\Filament\Icons\Enums\Phosphor;

class CheckboxCards extends CheckboxList
{
    use HasColumns;
    use HasExtraTexts;
    use HasIndicator;
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

    public function isItemsCenter(): bool
    {
        return (bool) $this->getExtraAttributeBag()->get('isCentered');
    }

    public function itemsCenter(bool|Closure $condition = true): static
    {
        $this->extraAttributes([
            'isCentered' => $condition,
        ], merge: true);

        return $this;
    }
}
