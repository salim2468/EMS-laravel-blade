<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkFromHomeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'approved_by',
        'start_date',
        'end_date',
        'count',
        'status',
    ];
}
