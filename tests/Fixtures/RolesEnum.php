<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Tests\Fixtures;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use ToneGabes\BetterOptions\Contracts\HasExtraText;

/**
 * Test fixture enum implementing every contract the package supports.
 */
enum RolesEnum: string implements HasColor, HasDescription, HasExtraText, HasIcon, HasLabel
{
    case Manager = 'manager';
    case Editor = 'editor';
    case Viewer = 'viewer';
    case Creator = 'creator';

    public function getLabel(): string
    {
        return match ($this) {
            self::Manager => 'Manager',
            self::Editor  => 'Editor',
            self::Viewer  => 'Viewer',
            self::Creator => 'Creator',
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::Manager => 'Allows managing the model.',
            self::Editor  => 'Allows editing the model.',
            self::Viewer  => 'Allows viewing the model.',
            self::Creator => 'Allows creating a new model.',
        };
    }

    public function getExtraText(): string
    {
        return match ($this) {
            self::Manager => 'extra.manager',
            self::Editor  => 'extra.editor',
            self::Viewer  => 'extra.viewer',
            self::Creator => 'extra.creator',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Manager => 'heroicon-o-cog',
            self::Editor  => 'heroicon-o-pencil',
            self::Viewer  => 'heroicon-o-eye',
            self::Creator => 'heroicon-o-plus',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Manager => 'danger',
            self::Editor  => 'warning',
            self::Viewer  => 'info',
            self::Creator => 'success',
        };
    }
}
