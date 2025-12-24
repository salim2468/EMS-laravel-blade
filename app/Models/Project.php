<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    const STATUS = [
        'pending'     => 'Pending',
        'in_progress' => 'Inprogress',
        'completed'   => 'Completed',
        'on_hold'     => 'Onhold',
        'cancelled'   => 'Cancelled'
    ];

    const TYPE = [
        'in_house' => "In house",
        'client'   => "Client"
    ];

    protected $fillable = [
        'title',
        'type',
        'manager_id',
        'start_date',
        'end_date',
        'status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
