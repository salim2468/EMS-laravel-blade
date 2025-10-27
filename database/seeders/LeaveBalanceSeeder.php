<?php

namespace Database\Seeders;

use App\Models\LeaveBalance;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeaveBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
    $leaveTypes = LeaveType::all();

    foreach ($users as $user) {
        foreach ($leaveTypes as $type) {
            LeaveBalance::firstOrCreate([
                'user_id' => $user->id,
                'leave_type_id' => $type->id,
            ], [
                'total_days' => 12,
                'used_days' => 0,
            ]);
        }
    }
    }
}
