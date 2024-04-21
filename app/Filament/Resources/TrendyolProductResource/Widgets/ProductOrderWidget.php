<?php

namespace App\Filament\Resources\TrendyolProductResource\Widgets;

use Filament\Widgets\ChartWidget;

class ProductOrderWidget extends ChartWidget
{
    protected static ?string $heading = 'Sıralama';
    protected static ?string $maxHeight = '300px';
    protected static ?string $pollingInterval = null;
    protected $histories;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Ürün Sıralaması',
                    'data' => $this->histories?->map(fn ($history) => $history->product_order)->toArray(),
                ],
            ],
            'labels' => $this->histories?->map(fn ($history) => $history->created_at->format('d.m.Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function mount(): void
    {
        $this->histories = func_get_arg(0);
        parent::mount();
    }
}
