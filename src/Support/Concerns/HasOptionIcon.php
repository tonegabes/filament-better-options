<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Support\Concerns;

use BackedEnum;
use Closure;
use Filament\Forms\Components\Concerns\HasIcons;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;

trait HasOptionIcon
{
    use HasIcons;

    protected bool | Closure $isIconVisible = true;

    protected ?IconPosition $iconPosition = null;

    public function defaultIconPosition(): IconPosition
    {
        return IconPosition::After;
    }

    public function isIconVisible(): bool
    {
        return (bool) $this->evaluate($this->isIconVisible);
    }

    public function hiddenIcon(bool | Closure $condition = true): static
    {
        $this->isIconVisible = ! $condition;

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
    public function getOptionIcon(mixed $value): string | BackedEnum | Htmlable | null
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
            return $this->defaultIconPosition() === IconPosition::Before;
        }

        return $this->iconPosition === IconPosition::Before;
    }

    public function hasIconAfter(): bool
    {
        if ($this->iconPosition === null) {
            return $this->defaultIconPosition() === IconPosition::After;
        }

        return $this->iconPosition === IconPosition::After;
    }
}
