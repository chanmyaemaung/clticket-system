<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin_chen_password'),
                'remember_token' => null,
            ],
            [
                'name' => 'Agent',
                'email' => 'agent@agent.com',
                'password' => bcrypt('agent_chen_password'),
                'remember_token' => null,
            ]
        ];

        User::insert($users);
    }
}
