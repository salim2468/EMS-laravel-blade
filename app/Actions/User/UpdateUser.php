<?php

namespace App\Actions\User;

use App\Models\User;

class UpdateUser
{
    /**
     * @param  User  $user
     * @param  array  $inputs
     */
    public function execute(User $user, array $inputs)
    {
        $user->update($inputs);
    }
}
