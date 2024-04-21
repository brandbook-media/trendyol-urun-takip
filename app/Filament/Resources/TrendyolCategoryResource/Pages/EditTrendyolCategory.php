<?php

namespace App\Filament\Resources\TrendyolCategoryResource\Pages;

use App\Filament\Resources\TrendyolCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrendyolCategory extends EditRecord
{
    protected static string $resource = TrendyolCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
