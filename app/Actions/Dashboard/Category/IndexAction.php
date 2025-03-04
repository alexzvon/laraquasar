<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use App\Models\Characteristic;

class IndexAction
{
    public function __invoke($categoryId): array
    {
        return [
            'categories' => fn() => Category::getAll(),
            'category' => fn() => $categoryId > 0 ? Category::find($categoryId) : null,
            'characteristics' => fn() => $this->getCharacteristics(),
                // $categoryId > 0 ? 
                //     Category::find($categoryId)
                //         ->characteristics()
                //         ->with('children')
                //         ->orderBy('sort')
                //         ->orderBy('id')
                //         ->get()
                //         ->makeHidden(['created_at', 'updated_at'])
                //         ->toTree()
                //         ->toArray() :
                // null,
            'characteristic' => fn() => null,
                // $characteristicId > 0 ? 
                //     Characteristic::query()
                //         ->where('id', $characteristicId)
                //         ->where('category_id', $categoryId)
                //         ->first() : 
                // null,
        ];
    }

    public function getCharacteristics(): array
    {
        return Characteristic::with('children')
            ->orderBy('sort')
            ->orderBy('id')
            ->get()
            ->makeHidden([ 'created_at', 'updated_at'])
            ->toTree()
            ->toArray();
    }
}
