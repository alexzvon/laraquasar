<?php

namespace App\Models;

use App\Enums\TypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Characteristic extends Model
{
    /** @use HasFactory<\Database\Factories\CharacteristicFactory> */
    use HasFactory, NodeTrait;

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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
