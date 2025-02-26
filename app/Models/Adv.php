<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property array<array-key, mixed>|null $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Database\Factories\AdvFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adv newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adv newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adv query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adv whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adv whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adv wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adv whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adv whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adv whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Adv extends Model
{
    /** @use HasFactory<\Database\Factories\AdvFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'advs';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'picture',
    ];

    /**
     * @var array<string,string>
     */
    protected $casts = [
        'picture' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Adv $adv) {
            $adv->slug = $adv->slug ?? Str::slug($adv->title);
        });
    }
}
