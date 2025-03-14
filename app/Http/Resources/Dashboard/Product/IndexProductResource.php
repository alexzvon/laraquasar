<?php

namespace App\Http\Resources\Dashboard\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'active' => $this->active,
            'sort' => $this->sort,
            'title' => $this->title,
            'slug' => $this->slug,
            'price' => $this->price,
            'description' => $this->description,
            'picture_image' => $this->picture_image ?? [],      //TODO $this->picture_image ?? []
        ];
    }
}
