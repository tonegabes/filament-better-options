<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Enums;

enum ComponentStyles: string
{
    case List = 'list';
    case Cards = 'cards';
    case StackedCards = 'stacked_cards';
    case Table = 'table';
}
