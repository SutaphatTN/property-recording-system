<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin',
                'username' => 'admin@admin.com',
                'role' => 'audit',
                'password' => bcrypt('1234')
            ],
            [
                'name' => 'User',
                'username' => 'user@user.com',
                'role' => 'staff',
                'password' => bcrypt('1234')
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
