<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class CreateUser
{
    /**
     * @param  array  $input
     */
    public function execute(array $input)
    {
        if (isset($input['profile_img']) && $input['profile_img'] instanceof UploadedFile) {
            $input['profile_img'] = $input['profile_img']->store('profile_images', 'public');
        }

        $validated['password'] = bcrypt('password');

        User::create($validated);
    }
}
