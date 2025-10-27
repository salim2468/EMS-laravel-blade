<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    const LEAVE_STATUS_PENDING = 'Pending';
    const LEAVE_STATUS_APPROVED = 'Approved';
    const LEAVE_STATUS_REJECTED = 'Rejected';

}
