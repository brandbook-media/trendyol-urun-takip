<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrendyolProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'trendyol_id',
        'name',
        'description',
        'url',
        'price',
        'brand',
        'image',
        'category',
    ];

    public function histories()
    {
        return $this->hasMany(TrendyolProductHistory::class);
    }

    public function getImageUrlAttribute()
    {
        return sprintf('https://cdn.dsmcdn.com%s', $this->image);
    }

    public function getCommentCountAttribute()
    {
        return $this->histories()->latest()->first()?->comment_count;
    }
}
