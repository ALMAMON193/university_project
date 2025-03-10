<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the IDs of the insertade users
        $users = DB::table('users')->pluck('id', 'email');

        // Insert card
        DB::table('cards')->insert([
            [
                'user_id' => $users['admin@email.com'],
                'card_name' => null,
                'card_number' => null,
                'cvc' => null,
                'expiry_date' => null,
                'created_at' => now(),
            ],
            [
                'user_id' => $users['user@email.com'],
                'card_name' => 'VISA',
                'card_number' => '1234 1234 1234 1234',
                'cvc' => '123',
                'expiry_date' => '12/29',
                'created_at' => now(),
            ]

        ]);
    }
}
