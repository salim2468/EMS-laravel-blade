<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class FilterUser
{
    protected $query;

    public function __construct(User $user)
    {
        $this->query = $user->query();
    }
    /**
     * @param  array  $params
     */
    public function execute(array $params = [])
    {
        if ($id = Arr::pull($params, 'id')) {
            $this->query->where('id', $id);
        }

        if ($name = Arr::pull($params, 'name')) {
            $this->query->where('name', $name);
        }

        if ($email = Arr::pull($params, 'email')) {
            $this->query->where('email', $email);
        }

        if ($phone = Arr::pull($params, 'phone')) {
            $this->query->where('phone', $phone);
        }

        if ($employmentType = Arr::pull($params, 'employment_type')) {
            $this->query->where('employment_type', $employmentType);
        }
        Log::debug(json_encode($params));
        if ($keyword = Arr::pull($params, 'keyword')) {
            $this->query->where('name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%")
                ->orWhere('phone', 'like', "%$keyword%")
                ->orWhere('employment_type', 'like', "%$keyword%");
        }

        return $this->query;
    }
}
