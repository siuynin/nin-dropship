<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryPost extends Model
{
    use HasFactory;
    protected $table = 'category_post';
    protected $fillable = [
        'name',
        'image',
        'description',
        'seo_keyword',
        'seo_description',
        'slug',  // Thêm trường slug vào $fillable
    ];

    // Hook vào sự kiện tạo mới hoặc cập nhật để tự động tạo slug
    public static function boot()
    {
        parent::boot();

        static::saving(function ($categoryPost) {
            if (!$categoryPost->slug) {
                $categoryPost->slug = Str::slug($categoryPost->name, '-');
            }
        });
    }
}
