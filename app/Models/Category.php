<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model    // implements HasMedia
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, NodeTrait;     // , InteractsWithMedia;

    const CACHE_ALL = 'allTreeCategory';

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'parent_id',
        'sort',
        'title',
        'slug',
        'count_products',
        'picture_icon',
        'picture_image',
    ];

    protected $attributes = [
        'count_products' => 0,
    ];

    protected $hidden = [
        '_lft',
        '_rgt',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Category $category) {
            $category->slug = $category->slug ?? Str::slug($category->title);
        });
    }

    public function characteristics(): HasMany
    {
        return $this->hasMany(Characteristic::class);
    }

    public static function getAll(): array
    {
        return match (Cache::has(self::CACHE_ALL)) {
            true => Cache::get(self::CACHE_ALL),
            default => tap(
                self::with('children')
                    ->orderBy('sort')
                    ->orderBy('id')
                    ->get()
                    ->makeHidden(['created_at', 'updated_at'])
                    ->toTree()
                    ->toArray(),
                fn ($all) => Cache::put(self::CACHE_ALL, $all)
            ),
        };
    }

    public static function clearCache(): bool
    {
        return Cache::forget(self::CACHE_ALL);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('d.m.Y H:i:s');
    }
}
