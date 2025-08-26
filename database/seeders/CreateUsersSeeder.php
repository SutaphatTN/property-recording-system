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
                'email' => 'admin@admin.com',
                'role' => 'audit',
                'password' => bcrypt('1234')
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'role' => 'staff',
                'password' => bcrypt('1234')
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
