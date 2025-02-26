<?php

namespace App\Actions\Dashboard\Color;

use App\Models\Color;
use Illuminate\Support\Facades\Storage;

class DestroyColorAction
{
    public function __invoke(int $id): int
    {
        if (is_dir(config('filesystems.disks.public.root').'/images/color/'.$id)) {
            Storage::disk('public')->deleteDirectory('/images/color/'.$id);
        }

        return Color::destroy($id);
    }
}
