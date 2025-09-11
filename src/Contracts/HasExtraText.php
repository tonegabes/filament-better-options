<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Contracts;

use Illuminate\Contracts\Support\Htmlable;

interface HasExtraText
{
    public function getExtraText(): string|Htmlable|null;
}
