<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'full_name' => 'Admin User',
                'email' => 'admin@email.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345@Aa'),
                'role' => 'admin',
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ],
            [
                'full_name' => 'Jane Smith',
                'email' => 'user@email.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345@Aa'),
                'role' => 'user',
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ],
        ]);

        // Get the IDs of the inserted users
        $users = DB::table('users')->pluck('id', 'email');

        // Insert user profiles
        DB::table('user_profiles')->insert([
            [
                'user_id' => $users['admin@email.com'],
                'avatar' => 'images/avatars/admin.jpg',
                'phone' => '1234567890',
                'address' => '123 Admin Street',
                'bio' => 'Administrator of the system.',
                'city' => 'Admin City',
                'state' => 'dhaka',
                'zip' => '12345',
                'created_at' => now(),
            ],
            [
                'user_id' => $users['user@email.com'],
                'avatar' => 'images/avatars/user.jpg',
                'phone' => '0987654321',
                'address' => '456 User Road',
                'bio' => 'Regular user of the system.',
                'city' => 'User City',
                'state' => 'dhaka',
                'zip' => '54321',
                'created_at' => now(),
            ],
        ]);
        // balance
        DB::table('user_balances')->insert([
            [
                'user_id' => $users['admin@email.com'],
                'balance' => 0,
                'created_at' => now(),
            ],
            [
                'user_id' => $users['user@email.com'],
                'balance' => 0,
                'created_at' => now(),
            ],
        ]);
    }
}