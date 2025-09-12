<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Contracts;

use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;

/**
 * Interface para provedores de ícones personalizados
 *
 * Permite que usuários implementem seus próprios provedores de ícones
 * para diferentes bibliotecas (Heroicons, Phosphor, Font Awesome, etc.)
 */
interface IconProvider
{
    /**
     * Obter ícones padrão para diferentes estados/tipos
     *
     * @return array<string, string|BackedEnum|Htmlable>
     */
    public function getDefaultIcons(): array;

    /**
     * Resolver um ícone para o formato apropriado
     */
    public function resolveIcon(string $iconName): string|BackedEnum|Htmlable;
}
