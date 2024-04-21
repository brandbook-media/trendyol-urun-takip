<?php

namespace App\Filament\Resources\TrendyolProductResource\Pages;

use App\Filament\Resources\TrendyolProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrendyolProducts extends ListRecords
{
    protected static string $resource = TrendyolProductResource::class;

    // protected static string $view = 'filament-panels::resources.pages.list-records';

    protected function getHeaderActions(): array
    {
        return [];
    }
}
