<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'count_products',
        'title',
        'slug',
        'href',
        'sort',
        'picture_image',
        'description',
    ];

    protected $attributes = [
        'count_products' => 0,
        'sort' => 100,
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Brand $brand) {
            $brand->slug = $brand->slug ?? Str::slug($brand->title);
        });
    }
}
