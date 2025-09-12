<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Providers;

use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use ToneGabes\BetterOptions\Contracts\IconProvider;
use ToneGabes\Filament\Icons\Enums\Phosphor;

class PhosphorIconsProvider implements IconProvider
{
    /**
     * @return array<string, string|BackedEnum|Htmlable>
     */
    public function getDefaultIcons(): array
    {
        return [
            // Indicadores de checkbox
            'checkbox_idle'     => Phosphor::SquareThin->getLabel(),
            'checkbox_selected' => Phosphor::CheckSquareFill->getLabel(),

            // Indicadores de radio
            'radio_idle'     => Phosphor::CircleThin->getLabel(),
            'radio_selected' => Phosphor::CheckCircleFill->getLabel(),

            // Ações de busca
            'search'       => Phosphor::MagnifyingGlass->getLabel(),
            'clear_search' => Phosphor::X->getLabel(),

            // Ações em lote
            'select_all'   => Phosphor::CheckCircle->getLabel(),
            'deselect_all' => Phosphor::XCircle->getLabel(),

            // Estados comuns
            'loading' => Phosphor::SpinnerGap->getLabel(),
            'error'   => Phosphor::WarningCircle->getLabel(),
            'success' => Phosphor::CheckCircle->getLabel(),

            // Navegação
            'chevron_up'    => Phosphor::CaretUp->getLabel(),
            'chevron_down'  => Phosphor::CaretDown->getLabel(),
            'chevron_left'  => Phosphor::CaretLeft->getLabel(),
            'chevron_right' => Phosphor::CaretRight->getLabel(),
        ];
    }

    public function resolveIcon(string $iconName): string|BackedEnum|Htmlable
    {
        $defaultIcons = $this->getDefaultIcons();

        return $defaultIcons[$iconName] ?? '';
    }
}
