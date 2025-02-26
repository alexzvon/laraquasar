<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * 
 *
 * @property int $id
 * @property int $category_id
 * @property int $brand_id
 * @property bool $active
 * @property string $title
 * @property string|null $slug
 * @property int $selling
 * @property int $discount
 * @property int $price
 * @property int $mean_grade
 * @property array<array-key, mixed>|null $picture
 * @property array<array-key, mixed>|null $recommend
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Brand $brand
 * @property-read \App\Models\Category $category
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ValueСharacteristic> $value
 * @property-read int|null $value_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereMeanGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereRecommend($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSelling($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array<string>
     */
    protected $filleble = [
        'active',
        'title',
        'slug',
        'selling',
        'discount',
        'price',
        'mean_grade',
        'picture',
        'recommend',
        'description',
    ];

    /**
     * @var array<string,mixed>
     */
    protected $attributes = [
        'active' => true,
        'selling' => 0,
        'discount' => 0,
        'price' => 0,
        'mean_grade' => 0,
    ];

    /**
     * @var array<string,string>
     */
    protected $casts = [
        'picture' => 'array',
        'recommend' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Product $product) {
            $product->slug = $product->slug ?? Str::slug($product->title);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function value(): HasMany
    {
        return $this->hasMany(ValueСharacteristic::class);
    }
}
