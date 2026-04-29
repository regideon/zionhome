<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CommandCenter extends Widget
{
    protected string $view = 'filament.widgets.command-center';

    protected int | string | array $columnSpan = 'full';
}
