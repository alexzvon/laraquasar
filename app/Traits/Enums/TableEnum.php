<?php

namespace App\Traits\Enums;

use App\Attributes\Enums\Table;
use ReflectionClassConstant;
use Illuminate\Support\Arr;

Trait TableEnum
{
    public function table(): string
    {
        $attributes = (new ReflectionClassConstant(
            class: self::class,
            constant: $this->name,
        ))->getAttributes(
            name: Table::class,
        );

        if ($attributes === []) {
            throw new \RuntimeException(
                message: 'No Table attribute found for ' . $this->name
            );
        }

        return Arr::first($attributes)->newInstance()->table;
    }
}
