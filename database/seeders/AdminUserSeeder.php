<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@school.test'],
            [
                'name' => 'System Admin',
                'password' => bcrypt('Admin1234'),
                'role' => 'admin',
                'status' => 'active',
                'must_change_password' => false,
            ]
        );
    }
}
