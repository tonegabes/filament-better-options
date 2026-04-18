<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use ToneGabes\BetterOptions\Enums\ComponentStyles;

/**
 * Radio rendered as stacked cards (vertical dense layout with joined borders).
 */
class RadioStackedCards extends RadioCards
{
    protected string $view = 'better-options::components.radio.stacked-cards';

    protected function setUp(): void
    {
        parent::setUp();

        $this->setComponentStyle(ComponentStyles::StackedCards);
        $this->columns(1);
    }
}
