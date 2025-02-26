<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    /** @use HasFactory<\Database\Factories\SlideFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'slides';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'href',
        'disk',
        'picture',
    ];

    /**
     * @var array<string, string>
     */
    protected $attributes = [
        'disk' => 'public',
    ];
}
