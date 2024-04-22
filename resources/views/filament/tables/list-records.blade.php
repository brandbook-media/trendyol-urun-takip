<x-filament-panels::page @class([
    'fi-resource-list-records-page',
    'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
])>
    <div class="flex flex-col gap-y-6">
        <x-filament-panels::resources.tabs />

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE, scopes: $this->getRenderHookScopes()) }}
        <div class="grid grid-cols-6" style="grid-template-columns: repeat(6, minmax(0, 1fr));display: grid;gap:10px">
            @foreach ($this->table->getQuery()->get() as $record)
                <a href="{{ route('filament.admin.resources.trendyol-products.view', $record) }}" class="overflow-hidden rounded-lg bg-white shadow" style="position: relative">
                    @if (strtolower($record->brand) == 'wefood')
                        <span
                            style="position: absolute; top:0;right:0; background-color:rgb(222, 64, 64);z-index:999;width:100%;color:#fff !important"
                            class="p-1 text-center">
                            Wefood
                        </span>
                    @endif
                    <div class="relative">
                        <img class="h-40 w-full object-cover" src="{{ $record->image_url }}" alt="{{ $record->name }}" />
                    </div>
                    <div class="p-4">
                        <h3 class="text-xs" style="color:#000">
                            <span class="text-sm font-semibold">
                                {{ $record->brand }}
                            </span>
                            {{ $record->name }}
                        </h3>
                        <div class="mt-2 flex items-center">
                            <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <!-- Yıldız SVG içeriği -->
                            </svg>
                            <span class="ml-1 text-xs text-gray-600">
                                @if ($record->comment_count)
                                    ({{ $record->comment_count }})
                                @else
                                    (0)
                                @endif
                            </span>
                        </div>
                        <div class="mt-2 flex items-baseline">
                            <span class="ml-2 text-sm text-gray-500">{{ $record->price }} TL</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_AFTER, scopes: $this->getRenderHookScopes()) }}
    </div>
</x-filament-panels::page>
