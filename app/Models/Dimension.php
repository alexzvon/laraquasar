<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    /** @use HasFactory<\Database\Factories\DimensionFactory> */
    use HasFactory;

    protected $table = 'dimensions';

    protected $fillable = [
        'title',
        'sort',
        'picture_image',
    ];

    protected $attribute = [
        'sort' => 100,
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
