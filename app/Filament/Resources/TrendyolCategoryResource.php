<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrendyolCategoryResource\Pages;
use App\Filament\Resources\TrendyolCategoryResource\RelationManagers;
use App\Models\TrendyolCategory;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrendyolCategoryResource extends Resource
{
    protected static ?string $model = TrendyolCategory::class;

    protected static ?string $navigationLabel = "Trendyol Kategorileri";

    protected static ?string $label = "Trendyol Kategorisi";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Kategori Adı(opsiyonel)'),
                Forms\Components\TextInput::make('url')
                    ->label('Kategori URL')
                    ->url()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif mi?')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('Tüm Kategorileri Getir')
                    ->action(function () {
                        TrendyolCategory::all()->each->fetchProducts();
                    })
                    ->requiresConfirmation()
                    ->color(Color::Blue)
                    ,
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Kategori Adı')
                    ->searchable(),
                Tables\Columns\TextColumn::make('products_count')
                    ->label('Ürün Toplamı'),
                Tables\Columns\TextColumn::make('url')
                    ->label('Kategori URL')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif mi?'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('fetch')
                    ->label('Ürünlerin Sonuçlarını Getir')
                    ->color(Color::Blue)
                    ->button()
                    ->action(function (TrendyolCategory $record) {
                        $record->fetchProducts();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrendyolCategories::route('/'),
            'create' => Pages\CreateTrendyolCategory::route('/create'),
            'view' => Pages\ViewTrendyolCategory::route('/{record}'),
            'edit' => Pages\EditTrendyolCategory::route('/{record}/edit'),
        ];
    }
}
