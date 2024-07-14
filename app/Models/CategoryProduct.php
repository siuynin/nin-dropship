<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $fillable = [
        'name', 'slug', 'image', 'parent_id', 'content', 'seo_keywords', 'seo_meta'
    ];

    public function parent()
    {
        return $this->belongsTo(CategoryProduct::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CategoryProduct::class, 'parent_id');
    }
}