<?php

declare(strict_types=1);

return [
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
