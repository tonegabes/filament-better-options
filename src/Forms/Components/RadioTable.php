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
 * Radio rendered as a responsive table layout.
 */
class RadioTable extends BaseRadio
{
    use HasBetterDescriptions;
    use HasExtraTexts;
    use HasIndicator;
    use HasOptionColor;
    use HasOptionIcon;

    protected string $view = 'better-options::components.radio.table';

    protected function setUp(): void
    {
        parent::setUp();

        $this->setComponentType(ComponentTypes::Radio);
        $this->setComponentStyle(ComponentStyles::Table);
    }
}
