<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\NameСharacteristic> $nameСharacteristic
 * @property-read int|null $nameсharacteristic_count
 * @method static \Database\Factories\GroupСharacteristicFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupСharacteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupСharacteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupСharacteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupСharacteristic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupСharacteristic whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupСharacteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupСharacteristic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupСharacteristic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GroupСharacteristic extends Model
{
    /** @use HasFactory<\Database\Factories\GroupСharacteristicFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'groupсharacteristics';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
    ];

    public function nameСharacteristic(): HasMany
    {
        return $this->hasMany(NameСharacteristic::class);
    }
}
