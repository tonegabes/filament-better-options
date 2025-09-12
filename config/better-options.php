<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Configuração de Ícones
    |--------------------------------------------------------------------------
    |
    | Configure o provedor de ícones para os componentes. Por padrão usa
    | Phosphor Icons, mas pode ser sobrescrito pelo usuário.
    |
    */

    'icons_provider' => ToneGabes\BetterOptions\Providers\PhosphorIconsProvider::class,

    /*
    |--------------------------------------------------------------------------
    | Posições Padrão
    |--------------------------------------------------------------------------
    |
    | Configure as posições padrão para ícones e indicadores em cada tipo
    | de componente. Valores possíveis: 'before', 'after'
    |
    */
    'default_positions' => [
        'checkbox_list' => [
            'icon'      => 'after',
            'indicator' => 'before',
        ],
        'checkbox_cards' => [
            'icon'      => 'before',
            'indicator' => 'after',
        ],
        'radio_list' => [
            'icon'      => 'after',
            'indicator' => 'before',
        ],
        'radio_cards' => [
            'icon'      => 'before',
            'indicator' => 'after',
        ],
    ],
];
