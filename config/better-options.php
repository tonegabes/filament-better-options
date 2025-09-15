<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Positions
    |--------------------------------------------------------------------------
    |
    | Configure a default positions for icons and indicators in each type
    | of component. Possible values: 'before', 'after'
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
        ],
    ],
];
