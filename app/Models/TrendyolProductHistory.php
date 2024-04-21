<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrendyolProductHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'trendyol_product_id',
        'comment_count',
        'product_order',
        'price',
    ];

    public function trendyolProduct()
    {
        return $this->belongsTo(TrendyolProduct::class);
    }
}
