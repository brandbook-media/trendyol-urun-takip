<?php

namespace App\Filament\Resources\TrendyolProductResource\Pages;

use App\Filament\Resources\TrendyolProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTrendyolProduct extends ViewRecord
{
    protected static string $resource = TrendyolProductResource::class;

    protected static string $view = 'pages.view-record';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
