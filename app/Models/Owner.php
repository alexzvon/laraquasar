<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $name
 * @property string|null $email
 * @property string|null $watsapp
 * @property string|null $phone
 * @property string|null $vk
 * @property string|null $telegram
 * @property string|null $youtube
 * @property string|null $rutube
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\OwnerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereRutube($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereTelegram($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereVk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereWatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereYoutube($value)
 * @mixin \Eloquent
 */
class Owner extends Model
{
    /** @use HasFactory<\Database\Factories\OwnerFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'owners';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'name',
        'email',
        'watsapp',
        'phone',
        'vk',
        'telegram',
        'vk',
        'youtube',
        'rutube',
        'address',
    ];
}
