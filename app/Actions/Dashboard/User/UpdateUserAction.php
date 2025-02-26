<?php

namespace App\Actions\Dashboard\User;

use Illuminate\Support\Facades\Hash;

class UpdateUserAction
{
    public function __invoke($user, $request): int
    {
        $update = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $update['password'] = Hash::make($request->password);
        }

        return $user->update($update);
    }
}
