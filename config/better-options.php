<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Positions
    |--------------------------------------------------------------------------
    |
    | Configure default positions for icons and indicators in each type
    | and style of component. Possible values: 'before', 'after'.
    |
    */
    'components' => [
        'checkbox' => [
            'list' => [
                'icon_position'      => 'after',
                'indicator_position' => 'before',
            ],
            'cards' => [
                'icon_position'      => 'before',
                'indicator_position' => 'after',
            ],
            'stacked_cards' => [
                'icon_position'      => 'before',
                'indicator_position' => 'after',
            ],
            'table' => [
                'icon_position'      => 'after',
                'indicator_position' => 'before',
            ],
        ],
        'radio' => [
            'list' => [
                'icon_position'      => 'after',
                'indicator_position' => 'before',
            ],
            'cards' => [
                'icon_position'      => 'before',
                'indicator_position' => 'after',
            ],
            'stacked_cards' => [
                'icon_position'      => 'before',
                'indicator_position' => 'after',
            ],
            'table' => [
                'icon_position'      => 'after',
                'indicator_position' => 'before',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Icon Defaults
    |--------------------------------------------------------------------------
    |
    | Override the built-in default indicator icons. Keys are:
    |   - checkbox_idle
    |   - checkbox_selected
    |   - radio_idle
    |   - radio_selected
    |
    | Values may be any icon reference accepted by Blade's @svg (Heroicons, Phosphor, Blade UI Kits, ...).
    |
    */
    'icons' => [
        'defaults' => [
            // 'checkbox_idle'     => 'heroicon-o-square',
            // 'checkbox_selected' => 'heroicon-s-check-circle',
            // 'radio_idle'        => 'heroicon-o-circle',
            // 'radio_selected'    => 'heroicon-s-check-circle',
        ],
    ],
];
