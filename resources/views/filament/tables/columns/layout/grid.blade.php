    @php
        $record = $getRecord();
    @endphp

    <div class="overflow-hidden rounded-lg bg-white shadow" style="position: relative">
        @if (strtolower($record->brand) == 'wefood')
            <span
                style="position: absolute; top:0;right:0; background-color:rgb(222, 64, 64);z-index:9;width:100%;color:#fff !important"
                class="p-1 text-center">
                Wefood
            </span>
        @endif
        <div class="relative">
            <img class="h-40 w-full object-cover" src="{{ $record->image_url }}" alt="{{ $record->name }}" />
        </div>
        <div class="p-4 flex flex-col gap-4">
            <h3 class="text-xs" style="color:#000">
                <span class="text-sm font-semibold">
                    {{ $record->brand }}
                </span>
                {{ $record->name }}
            </h3>
            <div class="mt-2 flex items-center">
                <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <a href="https://trendyol.com{{ $record->url }}" target="_blank" class="w-full text-white text-center font-semibold py-2 rounded-lg"
                style="background-color: rgb(59 130 246 / var(--tw-bg-opacity));">Ürüne Git</a>
        </div>
    </div>
