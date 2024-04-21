<?php

namespace App\Models;

use App\Jobs\FetchTrendyolProductJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrendyolCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'is_active'
    ];

    public function fetchProducts()
    {
        dispatch(new FetchTrendyolProductJob($this));
    }

    public function products()
    {
        return $this->hasMany(TrendyolProduct::class);
    }
}
