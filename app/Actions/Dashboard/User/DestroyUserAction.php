<?php

namespace App\Actions\Dashboard\User;

use App\Models\User;

class DestroyUserAction
{
    public function __invoke(User $user): int
    {
        return $user->delete();
    }
}
