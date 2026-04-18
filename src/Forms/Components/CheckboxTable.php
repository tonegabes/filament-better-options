<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use Filament\Forms\Components\CheckboxList as BaseCheckboxList;
use ToneGabes\BetterOptions\Concerns\HasBetterDescriptions;
use ToneGabes\BetterOptions\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Concerns\HasOptionColor;
use ToneGabes\BetterOptions\Concerns\HasOptionIcon;
use ToneGabes\BetterOptions\Enums\ComponentStyles;
use ToneGabes\BetterOptions\Enums\ComponentTypes;

/**
 * Checkbox list rendered as a responsive table layout.
 */
class CheckboxTable extends BaseCheckboxList
{
    use HasBetterDescriptions;
    use HasExtraTexts;
    use HasIndicator;
    use HasOptionColor;
    use HasOptionIcon;

    protected string $view = 'better-options::components.checkbox.table';

    protected function setUp(): void
    {
        parent::setUp();

        $this->setComponentType(ComponentTypes::Checkbox);
        $this->setComponentStyle(ComponentStyles::Table);
    }
}
