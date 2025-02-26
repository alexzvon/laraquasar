<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property int $nameсharacteristic_id
 * @property string $value
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ValueСharacteristicFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValueСharacteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValueСharacteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValueСharacteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValueСharacteristic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValueСharacteristic whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValueСharacteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValueСharacteristic whereNameсharacteristicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValueСharacteristic whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValueСharacteristic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValueСharacteristic whereValue($value)
 * @mixin \Eloquent
 */
class ValueСharacteristic extends Model
{
    /** @use HasFactory<\Database\Factories\ValueСharacteristicFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'valueсharacteristics';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'value',
        'description',
    ];
}
