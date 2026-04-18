<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use Filament\Forms\Components\Radio as BaseRadio;
use ToneGabes\BetterOptions\Concerns\HasBetterDescriptions;
use ToneGabes\BetterOptions\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Concerns\HasOptionColor;
use ToneGabes\BetterOptions\Concerns\HasOptionIcon;
use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;

/**
 * Enhanced radio list rendered as a vertical list with icons, descriptions,
 * extra texts and customizable indicators.
 *
 * Extends `Filament\Forms\Components\Radio` so all native features
 * (boolean(), inline(), state casts, validation rules) are preserved.
 */
class RadioList extends BaseRadio
{
    use HasBetterDescriptions;
    use HasExtraTexts;
    use HasIndicator;
    use HasOptionColor;
    use HasOptionIcon;

    protected string $view = 'better-options::components.radio.list';

    protected function setUp(): void
    {
        parent::setUp();

        $this->setComponentType(ComponentTypes::Radio);
        $this->setComponentStyle(ComponentStyles::List);
    }
}
