<?php

namespace App\Actions\Leave;

use App\Models\LeaveBalance;

class GetLeave
{
    protected $query;

    public function __construct(LeaveBalance $query)
    {
        $this->query = $query;
    }
    public function execute()
    {
        $user = auth()->user();
        $this->query->where('user_id', $user->id);
        
        return $this->query;
    }

}
