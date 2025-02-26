<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;

use App\Enums\OwnerShipEnum;

/**
 * 
 *
 * @property int $id
 * @property OwnerShipEnum $type
 * @property string|null $telegram
 * @property string|null $whatsapp
 * @property string|null $site
 * @property string|null $vk
 * @property string|null $inn
 * @property string|null $ogrnip
 * @property array<array-key, mixed>|null $email
 * @property array<array-key, mixed>|null $phone
 * @property array<array-key, mixed>|null $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereInn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereOgrnip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereTelegram($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereVk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereWhatsapp($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'profiles';

    protected $primaryKey = 'id';

    public $incrementing = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'type',
        'telegram',
        'whatsapp',
        'site',
        'vk',
        'inn',
        'ogrnip',
        'email',
        'phone',
        'picture',
    ];

    /**
     * Значения по умолчанию для атрибутов модели.
     *
     * @var array
     */
    protected $attributes = [
        'type' => OwnerShipEnum::Individual,
    ];

    /**
     * Получение атрибутов, которые должны быть типизированы.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => OwnerShipEnum::class,
            'email' => 'array',
            'phone' => 'array',
            'picture' => 'array',
        ];
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
