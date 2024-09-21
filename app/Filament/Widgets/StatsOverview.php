<?php

namespace App\Filament\Widgets;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('total class', Classes::count()),
            Stat::make('total section', Section::count()),
            Stat::make('total student', Student::count()),
        ];
    }
}
