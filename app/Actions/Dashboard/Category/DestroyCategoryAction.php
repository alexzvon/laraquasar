<?php

namespace App\Actions\Dashboard\Category;

// use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DestroyCategoryAction
{
    public function __invoke($id): void
    {
        if (is_dir(config('filesystems.disks.public.root').'/images/category/'.$id)) {
            Storage::disk('public')->deleteDirectory('images/category/'.$id);
        }

        if (is_dir(config('filesystems.disks.public.root').'/icons/category/'.$id)) {
            Storage::disk('public')->deleteDirectory('icons/category/'.$id);
        }

        Category::destroy($id);
        Category::clearCache();
    }
}
