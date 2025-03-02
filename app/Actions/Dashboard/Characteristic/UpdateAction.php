<?php

namespace App\Actions\Dashboard\Characteristic;

use App\Models\Characteristic;

class UpdateAction
{
    public function __invoke($data): array
    {
        if ($data->parent_id) {
            Characteristic::query()
                ->where('id', $data->id)
                ->update([
                    'smart' => $data->smart,
                    'type' => $data->type,
                    'sort' => $data->sort,
                    'title' => $data->title,
                    'description' => $data->description,
                ]
            );
        } else {
            Characteristic::query()
                ->where('id', $data->id)
                ->update([
                    'sort' => $data->sort,
                    'title' => $data->title,
                    'description' => $data->description,
                ]
            );
        }

        return [ 'characteristic_id' => $data->id ];
    }
}
