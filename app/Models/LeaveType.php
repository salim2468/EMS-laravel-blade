<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    const LEAVE_TYPE_PERSONAL   = 1;
    const LEAVE_TYPE_FLOATING   = 2;
    const LEAVE_TYPE_SICK       = 3;
    const LEAVE_TYPE_MATERNITY  = 4;

    const LEAVE_DAY_TYPE_HALF     = 'half';
    const LEAVE_DAY_TYPE_SINGLE   = 'single';
    const LEAVE_DAY_TYPE_MULTIPLE = 'multiple';

    protected $fillable = [
        'name',
        'count',
    ];

    public function leaveBalance()
    {
        return $this->hasMany(LeaveBalance::class);
    }
}
