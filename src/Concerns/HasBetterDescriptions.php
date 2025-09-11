<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Concerns;

use Closure;
use Filament\Forms\Components\Concerns\HasDescriptions;

trait HasBetterDescriptions
{
    use HasDescriptions;

    protected bool $isDescriptionVisible = true;

    public function isDescriptionVisible(): bool
    {
        return (bool) $this->evaluate($this->isDescriptionVisible);
    }

    public function hiddenDescription(bool|Closure $condition = true): static
    {
        $this->isDescriptionVisible = ! $condition;

        return $this;
    }
}
