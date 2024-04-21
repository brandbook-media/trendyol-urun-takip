<?php

namespace App\Jobs;

use App\Models\TrendyolCategory;
use App\Models\TrendyolProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\Pool;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchTrendyolProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public TrendyolCategory $category,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $categoryPath = str($this->category->url)->replace("https://www.trendyol.com/", "");

        if ($categoryPath->contains("?")) {
            $categoryPath = $categoryPath->append("&sst=BEST_SELLER&pi=1");
        } else {
            $categoryPath = $categoryPath->append("?sst=BEST_SELLER&pi=1");
        }

        $response = Http::get("https://public.trendyol.com/discovery-web-searchgw-service/v2/api/filter/{$categoryPath}");

        foreach ($response->collect('result.products') as $productOrder => $product) {

            /**
             * @var TrendyolProduct $trendyolProduct
             */
            if (($trendyolProduct = TrendyolProduct::where('trendyol_id', data_get($product, 'id'))->first()) == null) {
                $trendyolProduct = $this->category->products()->create([
                    'trendyol_id' => data_get($product, 'id'),
                    'name' => data_get($product, 'name'),
                    'description' => data_get($product, 'name'),
                    'url' => data_get($product, 'url'),
                    'price' => data_get($product, 'price.sellingPrice'),
                    'brand' => data_get($product, 'brand.name'),
                    'image' => Arr::first(data_get($product, 'images')),
                    'category' => data_get($product, 'categoryName'),
                ]);
            }

            if (data_get($product, 'ratingScore') === null) {
                continue;
            }

            $trendyolProduct->histories()->create([
                'comment_count' => data_get($product, 'ratingScore.totalCount'),
                'product_order' => $productOrder + 1,
                'price' => data_get($product, 'price.sellingPrice')
            ]);
        }
    }
}
