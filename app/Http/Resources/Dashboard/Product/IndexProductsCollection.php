<?php

namespace App\Http\Resources\Dashboard\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function($item){
            return [
                'id' => $item->id,
                'active' => $item->active,
                'sort' => $item->sort,
                'title' => $item->title,
                'slug' => $item->slug,
                'price' => $item->price,
            ];
        })->toArray();
    }
}
