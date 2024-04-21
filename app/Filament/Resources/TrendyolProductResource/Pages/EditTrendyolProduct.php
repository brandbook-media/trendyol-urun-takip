<?php

namespace App\Filament\Resources\TrendyolProductResource\Pages;

use App\Filament\Resources\TrendyolProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrendyolProduct extends EditRecord
{
    protected static string $resource = TrendyolProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
