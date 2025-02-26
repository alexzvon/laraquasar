<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Enums\TypeEnum;

class Characteristic extends Model
{
    /** @use HasFactory<\Database\Factories\CharacteristicFactory> */
    use HasFactory;

    protected $table = 'characteristics';

    protected $fillable = [
        'parent_id',
        'sort',
        'title',
        'smart',
        'type',
        'category_id',
        'description',
    ];

    protected $attribute = [
        'type' => TypeEnum::Boolean,
        'sort' => 100,
    ];

    protected $hidden = [
        '_lft',
        '_rgt',
    ];

    protected $casts = [
        'type' => TypeEnum::class,
        'created_at' => 'Datatime',
        'updated_at' => 'Datatime',
    ];


}
