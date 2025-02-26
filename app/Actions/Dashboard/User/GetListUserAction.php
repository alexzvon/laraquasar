<?php

namespace App\Actions\Dashboard\User;

use App\Http\Resources\Dashboard\User\GetListUserCollection;
use App\Models\User;

class GetListUserAction
{
    public function __invoke(): GetListUserCollection
    {
        return GetListUserCollection::make(User::all());
    }
}
