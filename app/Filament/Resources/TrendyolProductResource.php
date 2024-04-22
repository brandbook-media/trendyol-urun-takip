<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrendyolProductResource\Pages;
use App\Filament\Resources\TrendyolProductResource\RelationManagers;
use App\Models\TrendyolCategory;
use App\Models\TrendyolProduct;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrendyolProductResource extends Resource
{
    protected static ?string $model = TrendyolProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = "Trendyol Ürün Listesi";

    protected static ?string $label = "Trendyol Ürünü";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('trendyol_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('trendyol_category_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->required(),
                Forms\Components\TextInput::make('url')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required(),
                Forms\Components\TextInput::make('brand')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('category')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Group::make('category')
                    ->label('Kategori'),
                Group::make('price')
                    ->label('Fiyat'),
                Group::make('created_at')
                    ->label('Oluşturulma Tarihi'),
                Group::make('brand')
                    ->label('Marka'),
            ])
            ->columns([
                Stack::make([
                    Tables\Columns\TextColumn::make('name')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('description')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('url')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('price')
                        ->label('Fiyat')
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('brand')
                        ->searchable(),
                    Tables\Columns\ImageColumn::make('image'),
                    Tables\Columns\TextColumn::make('category')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ])->view('filament.tables.columns.layout.grid')
            ])
            ->contentGrid([
                'md' => 3,
                'xl' => 4,
                '2xl' => 4,
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options(
                        TrendyolProduct::query()
                            ->select('category')
                            ->distinct()
                            ->get()
                            ->pluck('category')
                            ->mapWithKeys(fn ($category) => [$category => $category])
                            ->toArray()
                    )
                    ->label('Kategori'),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])

            ->bulkActions([]);
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
            'index' => Pages\ListTrendyolProducts::route('/'),
            'view' => Pages\ViewTrendyolProduct::route('/{record}'),
        ];
    }
}
