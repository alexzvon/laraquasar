<?php

namespace App\Actions\Dashboard\Characteristic;

use App\Models\Characteristic;

class CreateAction
{
    public function __invoke(Characteristic $root, $data): array
    {
        if ($data->parent_id) {
            $model = Characteristic::create([
                'title' => $data->title,
                'sort' => $data->sort,
                'smart' => $data->smart,
                'category_id' => $data->category_id,
                'type' => $data->type,
                'description' => $data->description,
            ], $root);
        } else {
            $model = Characteristic::create([
                'title' => $data->title,
                'sort' => $data->sort,
                'description' => $data->description,
                'category_id' => $data->category_id,
            ]);
        }

        return [ 'category_id' => $model->category_id, 'characteristic_id' => $model->id ];
    }
}