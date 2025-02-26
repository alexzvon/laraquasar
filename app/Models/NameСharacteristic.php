<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property int $groupсharacteristic_id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GroupСharacteristic|null $groupCharacteristic
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ValueСharacteristic> $valueСharacteristic
 * @property-read int|null $valueсharacteristic_count
 * @method static \Database\Factories\NameСharacteristicFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NameСharacteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NameСharacteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NameСharacteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NameСharacteristic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NameСharacteristic whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NameСharacteristic whereGroupсharacteristicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NameСharacteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NameСharacteristic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NameСharacteristic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NameСharacteristic extends Model
{
    /** @use HasFactory<\Database\Factories\NameСharacteristicFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'nameсharacteristics';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'decription',
    ];

    public function groupCharacteristic(): BelongsTo
    {
        return $this->belongsTo(GroupСharacteristic::class);
    }

    public function valueСharacteristic(): HasMany
    {
        return $this->hasMany(ValueСharacteristic::class);
    }
}
