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
            'category' => fn() => $categoryId > 0 ? $this->getCategory($categoryId) : null,
            'characteristics' => fn() => $this->getCharacteristics(),
            // 'characteristic' => fn() => null,
        ];
    }

    protected function getCharacteristics(): array
    {
        return Characteristic::with('children')
            ->orderBy('sort')
            ->orderBy('id')
            ->get()
            ->makeHidden([ 'created_at', 'updated_at'])
            ->toTree()
            ->toArray();
    }

    protected function getCategory(int $categoryId)
    {
        return Category::with(['characteristics'])->find($categoryId);
    }
}
