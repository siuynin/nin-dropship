<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'image',
        'content',
        'seo_description',
        'seo_keyword',
    ];

    // Hook vào sự kiện tạo mới hoặc cập nhật để tự động tạo slug
    public static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            $post->slug = Str::slug($post->title, '-');
        });
    }

    public function category()
    {
        return $this->belongsTo(CategoryPost::class, 'category_id');
    }
}
