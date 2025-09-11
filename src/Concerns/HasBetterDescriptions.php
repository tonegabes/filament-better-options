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
        return $this->isDescriptionVisible;
    }

    public function hiddenDescription(bool|Closure $condition = true): static
    {
        $this->isDescriptionVisible = ! $this->evaluate($condition);

        return $this;
    }
}
