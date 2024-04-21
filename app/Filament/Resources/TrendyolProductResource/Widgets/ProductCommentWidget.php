<?php

namespace App\Filament\Resources\TrendyolProductResource\Widgets;

use App\Models\TrendyolProduct;
use Filament\Widgets\ChartWidget;

class ProductCommentWidget extends ChartWidget
{
    protected static ?string $heading = 'Yorumlar';
    protected static ?string $maxHeight = '300px';
    protected static ?string $pollingInterval = null;
    protected $histories;

    protected $product;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Yorumlar',
                    'data' => $this->histories?->map(fn ($history) => $history->comment_count)->toArray(),
                ],
            ],
            'labels' => $this->histories?->map(fn ($history) => $history->created_at->format('d.m.Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function mount(): void
    {
        $this->histories = func_get_arg(0);
        parent::mount();
    }
}
