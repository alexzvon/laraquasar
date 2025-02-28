<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DestroyAction
{
    public function __invoke($id): array
    {
        if ($id != 1) {
            if (is_dir(config('filesystems.disks.public.root').'/images/category/'.$id)) {
                Storage::disk('public')->deleteDirectory('images/category/'.$id);
            }

            if (is_dir(config('filesystems.disks.public.root').'/icons/category/'.$id)) {
                Storage::disk('public')->deleteDirectory('icons/category/'.$id);
            }

            Category::destroy($id);
            Category::clearCache();
        }

        return [ 'category_id' => 1, 'characteristic_id' => 0 ];
    }
}
