<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'active',
        'sort',
        'price',
        'title',
        'slug',
        'picture_image',
        'description',
    ];

    protected $attributes = [
        'active' => true,
        'sort' => 100,
        'price' => 0,
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::created(function (Product $product) {
            $product->slug = $product->slug ?? Str::slug($product->title);
        });
    }
}
