<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Concerns;

use BackedEnum;
use Closure;
use Filament\Forms\Components\Concerns\HasIcons;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Config;
use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ValueError;

trait HasOptionIcon
{
    use HasIcons;

    protected ?ComponentStyles $componentStyle = null;

    protected bool $isIconVisible = true;

    protected ?IconPosition $iconPosition = null;

    public function setComponentStyle(ComponentStyles $style): void
    {
        $this->componentStyle = $style;
    }

    public function isIconVisible(): bool
    {
        return $this->isIconVisible;
    }

    public function hiddenIcon(bool|Closure $condition = true): static
    {
        $this->isIconVisible = ! $this->evaluate($condition);

        return $this;
    }

    /**
     * @param  array-key  $value
     */
    public function hasIcon($value): bool
    {
        if (! $this->isIconVisible) {
            return false;
        }

        return array_key_exists($value, $this->getIcons());
    }

    /**
     * @param  array-key  $value
     */
    public function getOptionIcon(mixed $value): string|BackedEnum|Htmlable|null
    {
        return $this->getIcon($value);
    }

    public function getOptionIconPosition(): ?IconPosition
    {
        return $this->iconPosition;
    }

    public function iconPosition(IconPosition $position): static
    {
        $this->iconPosition = $position;

        return $this;
    }

    public function iconBefore(): static
    {
        $this->iconPosition = IconPosition::Before;

        return $this;
    }

    public function iconAfter(): static
    {
        $this->iconPosition = IconPosition::After;

        return $this;
    }

    public function isIconBefore(): bool
    {
        if ($this->iconPosition === null) {
            return $this->getDefaultIconPosition() === IconPosition::Before;
        }

        return $this->iconPosition === IconPosition::Before;
    }

    public function isIconAfter(): bool
    {
        if ($this->iconPosition === null) {
            return $this->getDefaultIconPosition() === IconPosition::After;
        }

        return $this->iconPosition === IconPosition::After;
    }

    public function getDefaultIconPosition(): IconPosition
    {
        if (! isset($this->componentType) || ! isset($this->componentStyle)) {
            return IconPosition::After;
        }

        $position = Config::string(
            'better-options.components.'
            .$this->componentType->value
            .'.'
            .$this->componentStyle->value
            .'.icon_position'
        );

        try {
            $position = IconPosition::from($position);
        } catch (ValueError $e) {
            return IconPosition::After;
        }

        return $position;
    }
}
