<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin-1',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('password'),
                'province' => 'dummy_province',
                'district' => 'dummy_district',
                'address' => 'dummy_address',
                'phone' => '9812345678',
                'date_of_birth' => '2002-01-01',
                'gender' => 'male',
                'joined_date' => '2004-01-01',
                'job_title' => 'admin',
                'employment_type' => 'full-time',
                'status' => 'active'
            ],
            [
                'name' => 'manager-1',
                'email' => 'manager1@gmail.com',
                'password' => bcrypt('password'),
                'province' => 'dummy_province',
                'district' => 'dummy_district',
                'address' => 'dummy_address',
                'phone' => '9812345671',
                'date_of_birth' => '2002-01-01',
                'gender' => 'male',
                'joined_date' => '2004-01-01',
                'job_title' => 'mangager',
                'employment_type' => 'full-time',
                'status' => 'active'
            ],
            [
                'name' => 'user-1',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('password'),
                'province' => 'dummy_province',
                'district' => 'dummy_district',
                'address' => 'dummy_address',
                'phone' => '9812345672',
                'date_of_birth' => '2002-01-01',
                'gender' => 'male',
                'joined_date' => '2004-01-01',
                'job_title' => 'developer',
                'employment_type' => 'full-time',
                'status' => 'active'
            ]
        ];
        $roles = ['admin', 'manager', 'user'];

        foreach ($users as $index => $user) {
            $user = User::create($user);
            $user->syncRoles($roles[$index]);
        }

        // assign manager id to user
        $manager = User::where('email', 'manager1@gmail.com')->first();
        User::where('email', 'user1@gmail.com')->update('manager_id', $manager->id);
    }
}
