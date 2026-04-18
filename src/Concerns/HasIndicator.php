<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Concerns;

use BackedEnum;
use Closure;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;
use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;
use ToneGabes\BetterOptions\Services\IconManagerService;
use ToneGabes\BetterOptions\Services\IconResolverService;
use ValueError;

trait HasIndicator
{
    protected ?ComponentTypes $componentType = null;

    protected string|BackedEnum|Htmlable|null $idleIndicator = null;

    protected string|BackedEnum|Htmlable|null $selectedIndicator = null;

    protected ?IconPosition $indicatorPosition = null;

    protected bool $isIndicatorVisible = true;

    protected bool $isIndicatorPartiallyHidden = false;

    public function setComponentType(ComponentTypes $type): void
    {
        $this->componentType = $type;
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

    public function indicatorPosition(IconPosition $position): static
    {
        $this->indicatorPosition = $position;

        return $this;
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

    public function isIndicatorBefore(): bool
    {
        if ($this->indicatorPosition === null) {
            return $this->getDefaultIndicatorPosition() === IconPosition::Before;
        }

        return $this->indicatorPosition === IconPosition::Before;
    }

    public function isIndicatorAfter(): bool
    {
        if ($this->indicatorPosition === null) {
            return $this->getDefaultIndicatorPosition() === IconPosition::After;
        }

        return $this->indicatorPosition === IconPosition::After;
    }

    public function hiddenIndicator(bool|Closure $condition = true): static
    {
        $this->isIndicatorVisible = ! $this->evaluate($condition);

        return $this;
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

    public function isIndicatorPartiallyHidden(): bool
    {
        return $this->isIndicatorPartiallyHidden;
    }

    public function getIdleIndicator(): string|BackedEnum|Htmlable
    {
        return $this->idleIndicator ?? $this->getDefaultIdleIndicator();
    }

    public function getSelectedIndicator(): string|BackedEnum|Htmlable
    {
        return $this->selectedIndicator ?? $this->getDefaultSelectedIndicator();
    }

    public function getDefaultIndicatorPosition(): IconPosition
    {
        if (! isset($this->componentType) || ! isset($this->componentStyle)) {
            return IconPosition::Before;
        }

        $position = $this->readComponentConfig(
            $this->componentType,
            $this->componentStyle,
            'indicator_position',
        );

        try {
            return IconPosition::from((string) $position);
        } catch (ValueError $e) {
            return IconPosition::Before;
        }
    }

    /**
     * Read a component-scoped setting from the package config.
     *
     * Extracted as a separate method so tests can override it without
     * touching the Laravel Config facade.
     */
    protected function readComponentConfig(
        ComponentTypes $type,
        ComponentStyles $style,
        string $setting,
    ): ?string {
        $key = sprintf(
            'better-options.components.%s.%s.%s',
            $type->value,
            $style->value,
            $setting,
        );

        $value = function_exists('config') ? config($key) : null;

        return is_string($value) ? $value : null;
    }

    public function getDefaultIdleIndicator(): string|BackedEnum|Htmlable
    {
        return IconManagerService::resolveIndicatorIcon($this->componentType, 'idle');
    }

    public function getDefaultSelectedIndicator(): string|BackedEnum|Htmlable
    {
        return IconManagerService::resolveIndicatorIcon($this->componentType, 'selected');
    }

    protected function getFallbackIdleIndicator(): string|BackedEnum|Htmlable
    {
        $key = $this->componentType === ComponentTypes::Checkbox
            ? IconResolverService::KEY_CHECKBOX_IDLE
            : IconResolverService::KEY_RADIO_IDLE;

        return IconResolverService::default($key);
    }

    protected function getFallbackSelectedIndicator(): string|BackedEnum|Htmlable
    {
        $key = $this->componentType === ComponentTypes::Checkbox
            ? IconResolverService::KEY_CHECKBOX_SELECTED
            : IconResolverService::KEY_RADIO_SELECTED;

        return IconResolverService::default($key);
    }
}
