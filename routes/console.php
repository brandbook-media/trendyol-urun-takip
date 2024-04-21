<?php

use App\Models\TrendyolCategory;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    TrendyolCategory::all()->each(function (TrendyolCategory $category) {
        $category->fetchProducts();
    });
})->daily();
