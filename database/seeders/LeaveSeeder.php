<?php

namespace Database\Seeders;

use App\Models\LeaveBalance;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $leaves = LeaveType::all();
        $users = User::all();
        foreach ($leaves as $leave) {
            foreach ($users as $user) {
                LeaveBalance::create(
                    [
                        'user_id' => $user->id,
                        'leave_type_id' => $leave->id,
                        'total_days' => $leave->count,
                        'used_days' => 0,
                    ]
                );
            }
        }
    }
}
