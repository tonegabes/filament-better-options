<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Concerns;

use Closure;

trait HasItemsCenter
{
    protected bool $isItemsCenter = false;

    public function isItemsCenter(): bool
    {
        return $this->isItemsCenter;
    }

    public function itemsCenter(bool|Closure $condition = true): static
    {
        $this->isItemsCenter = (bool) $this->evaluate($condition);

        return $this;
    }
}
