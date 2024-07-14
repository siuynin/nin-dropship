<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'sku_parents', 'product_name', 'image_url', 'image', 'category_id', 
        'sell_price', 'prev_price', 'video_url', 'sourceFrom', 'content', 
        'seo_keywords', 'seo_meta'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }
}