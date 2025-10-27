<?php

namespace App\Http\Controllers\AdminController;

use App\Models\User;

class DeleteUser
{
    /**
     * @param  User  $user
     */
    public function execute(User $user)
    {
        $user->delete();
    }
}
