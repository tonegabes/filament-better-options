<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Concerns;

use BackedEnum;
use Closure;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;
use ToneGabes\Filament\Icons\Enums\Phosphor;

trait HasIndicator
{
    protected bool $isIndicatorPartiallyHidden = false;

    protected bool $isIndicatorVisible = true;

    protected ?IconPosition $indicatorPosition = null;

    protected string|BackedEnum|Htmlable|null $idleIndicator = null;

    protected string|BackedEnum|Htmlable|null $selectedIndicator = null;

    abstract public function defaultIndicatorPosition(): IconPosition;

    public function isIndicatorPartiallyHidden(): bool
    {
        return $this->isIndicatorPartiallyHidden;
    }

    public function partiallyHiddenIndicator(bool|Closure $condition = true): static
    {
        $this->isIndicatorPartiallyHidden = (bool) $this->evaluate($condition);

        return $this;
    }

    public function isIndicatorVisible(): bool
    {
        return $this->isIndicatorVisible;
    }

    public function hiddenIndicator(bool|Closure $condition = true): static
    {
        $this->isIndicatorVisible = ! $this->evaluate($condition);

        return $this;
    }

    public function indicatorPosition(IconPosition $position): static
    {
        $this->indicatorPosition = $position;

        return $this;
    }

    public function isIndicatorBefore(): bool
    {
        if ($this->indicatorPosition === null) {
            return $this->defaultIndicatorPosition() === IconPosition::Before;
        }

        return $this->indicatorPosition === IconPosition::Before;
    }

    public function isIndicatorAfter(): bool
    {
        if ($this->indicatorPosition === null) {
            return $this->defaultIndicatorPosition() === IconPosition::After;
        }

        return $this->indicatorPosition === IconPosition::After;
    }

    public function indicatorBefore(): static
    {
        $this->indicatorPosition = IconPosition::Before;

        return $this;
    }

    public function indicatorAfter(): static
    {
        $this->indicatorPosition = IconPosition::After;

        return $this;
    }

    public function defaultIdleIndicator(): string|BackedEnum|Htmlable
    {
        return Phosphor::CircleThin->getLabel();
    }

    public function defaultSelectedIndicator(): string|BackedEnum|Htmlable
    {
        return Phosphor::CheckCircleFill->getLabel();
    }

    public function getIdleIndicator(): string|BackedEnum|Htmlable
    {
        return $this->idleIndicator ?? $this->defaultIdleIndicator();
    }

    public function getSelectedIndicator(): string|BackedEnum|Htmlable
    {
        return $this->selectedIndicator ?? $this->defaultSelectedIndicator();
    }

    public function idleIndicator(string|BackedEnum|Htmlable|null $idleIndicator): static
    {
        if ($idleIndicator instanceof BackedEnum && $idleIndicator instanceof HasLabel) {
            $idleIndicator = $idleIndicator->getLabel();
        }

        $this->idleIndicator = $idleIndicator;

        return $this;
    }

    public function selectedIndicator(string|BackedEnum|Htmlable|null $selectedIndicator): static
    {
        if ($selectedIndicator instanceof BackedEnum && $selectedIndicator instanceof HasLabel) {
            $selectedIndicator = $selectedIndicator->getLabel();
        }

        $this->selectedIndicator = $selectedIndicator;

        return $this;
    }
}
