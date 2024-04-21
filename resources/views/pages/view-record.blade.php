<div class="flex flex-col gap-4">
    @livewire(\App\Filament\Resources\TrendyolProductResource\Widgets\ProductCommentWidget::class, [
        'histories' => $record->histories()->get(),
    ])

    @livewire(\App\Filament\Resources\TrendyolProductResource\Widgets\ProductOrderWidget::class, [
        'histories' => $record->histories()->get(),
    ])
    @livewire(\App\Filament\Resources\TrendyolProductResource\Widgets\ProductPriceWidget::class, [
        'histories' => $record->histories()->get(),
    ])
</div>
