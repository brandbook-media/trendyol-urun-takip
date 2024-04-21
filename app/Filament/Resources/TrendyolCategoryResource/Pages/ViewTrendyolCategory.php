<?php

namespace App\Filament\Resources\TrendyolCategoryResource\Pages;

use App\Filament\Resources\TrendyolCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTrendyolCategory extends ViewRecord
{
    protected static string $resource = TrendyolCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
