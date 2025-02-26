<?php

namespace App\Actions\Dashboard\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreUserAction
{
    public function __invoke($request): User
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
