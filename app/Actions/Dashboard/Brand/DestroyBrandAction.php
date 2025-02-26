<?php

namespace App\Actions\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class DestroyBrandAction
{
    public function __invoke(int $id): int
    {
        if (is_dir(config('filesystems.disks.public.root').'/images/brand/'.$id)) {
            Storage::disk('public')->deleteDirectory('images/brand/'.$id);
        }

        return Brand::destroy($id);
    }
}
