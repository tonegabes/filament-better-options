<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Concerns;

use BackedEnum;
use Closure;
use Filament\Forms\Components\Concerns\HasIcons;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;

trait HasOptionIcon
{
    use HasIcons;

    protected ?string $componentStyle = null;

    protected bool $isIconVisible = true;

    protected ?IconPosition $iconPosition = null;

    public function setComponentStyle(string $componentStyle): void
    {
        $this->componentStyle = $componentStyle;
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

    public function hasIconBefore(): bool
    {
        if ($this->iconPosition === null) {
            return $this->getDefaultIconPosition() === IconPosition::Before;
        }

        return $this->iconPosition === IconPosition::Before;
    }

    public function hasIconAfter(): bool
    {
        if ($this->iconPosition === null) {
            return $this->getDefaultIconPosition() === IconPosition::After;
        }

        return $this->iconPosition === IconPosition::After;
    }

    public function getDefaultIconPosition(): IconPosition
    {
        return match ($this->componentStyle) {
            'cards' => IconPosition::Before,
            'list'  => IconPosition::After,
            default => IconPosition::Before,
        };
    }
}
