<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Services;

use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use ToneGabes\BetterOptions\Contracts\IconProvider;

class IconManager
{
    private IconProvider $provider;

    public function __construct(IconProvider $provider)
    {
        $this->provider = $provider;
    }

    public function getProvider(): IconProvider
    {
        return $this->provider;
    }

    public function setProvider(IconProvider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function resolveIcon(string $iconName): string|BackedEnum|Htmlable
    {
        return $this->provider->resolveIcon($iconName);
    }

    /**
     * @return array<string, string|BackedEnum|Htmlable>
     */
    public function getDefaultIcons(): array
    {
        return $this->provider->getDefaultIcons();
    }

    public function getDefaultIcon(string $iconKey): string|BackedEnum|Htmlable
    {
        $defaultIcons = $this->getDefaultIcons();

        return $defaultIcons[$iconKey] ?? '';
    }
}
