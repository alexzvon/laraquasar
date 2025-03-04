<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use App\Models\Characteristic;

class AttachAction
{
    public function __invoke(int $category_id, int $characteristic_id): array
    {
        return match(Characteristic::find($characteristic_id)->parent_id) {
            null => [ 'category_id' => $category_id ],
            default => tap(
                [ 'category_id' => $category_id ],
                fn() => Category::find($category_id)->characteristics()->syncWithoutDetaching([ $characteristic_id ]),
            ) 
        };
    }
}
