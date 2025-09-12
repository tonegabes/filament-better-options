<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Forms\Components;

use Filament\Forms\Components\CheckboxList as BaseCheckboxList;
use ToneGabes\BetterOptions\Concerns\HasBetterDescriptions;
use ToneGabes\BetterOptions\Concerns\HasExtraTexts;
use ToneGabes\BetterOptions\Concerns\HasIndicator;
use ToneGabes\BetterOptions\Concerns\HasOptionIcon;

class CheckboxList extends BaseCheckboxList
{
    use HasBetterDescriptions;
    use HasExtraTexts;
    use HasIndicator;
    use HasOptionIcon;

    protected string $view = 'better-options::components.checkbox-list';

    protected function setUp(): void
    {
        parent::setUp();

        $this->setComponentType('checkbox');
        $this->setComponentStyle('list');
    }
}
