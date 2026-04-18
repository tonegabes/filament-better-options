<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use ToneGabes\BetterOptions\Enums\ComponentStyles;

/**
 * Checkbox list rendered as stacked cards (vertical dense layout with joined borders).
 */
class CheckboxStackedCards extends CheckboxCards
{
    protected string $view = 'better-options::components.checkbox.stacked-cards';

    protected function setUp(): void
    {
        parent::setUp();

        $this->setComponentStyle(ComponentStyles::StackedCards);
        $this->columns(1);
    }
}
