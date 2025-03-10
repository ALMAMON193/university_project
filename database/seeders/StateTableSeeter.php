<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeter extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("states")->insert([
            ['name' => 'Dhaka'],
            ['name' => 'Chittagong'],
            ['name' => 'Khulna'],
            ['name' => 'Rajshahi'],
            ['name' => 'Barisal'],
            ['name' => 'Sylhet'],
            ['name' => 'Rangpur'],
            ['name' => 'Mymensingh'],
            ['name' => 'Narsingdi'],
            ['name' => 'Tangail'],
            ['name' => 'Netrakona'],
            ['name' => 'Jamalpur'],
            ['name' => 'Manikganj'],
            ['name' => 'Munshiganj'],
            ['name' => 'Chandpur'],
            ['name' => 'Bhola'],
            ['name' => 'Barguna'],
            ['name' => 'Patuakhali'],
            ['name' => 'Lakshmipur'],
            ['name' => 'Noakhali'],
            ['name' => 'Feni'],
            ['name' => 'Comilla'],
            ['name' => 'Chattogram'],
            ['name' => 'Coxs Bazar'],
            ['name' => 'Bandarban'],
            ['name' => 'Rangamati'],
            ['name' => 'Khagrachari'],
            ['name' => 'Jessore'],
            ['name' => 'Bagerhat'],
            ['name' => 'Satkhira'],
            ['name' => 'Meherpur'],
            ['name' => 'Chuadanga'],
            ['name' => 'Rajbari'],
            ['name' => 'Brahmanbaria'],
            ['name' => 'Pabna'],
            ['name' => 'Magura'],
            ['name' => 'Madaripur'],
            ['name' => 'Kishoreganj'],
            ['name' => 'Moulvibazar'],
            ['name' => 'Naogaon'],
            ['name' => 'Jhinaidah'],
            ['name' => 'Jhalokathi']
        ]);
    }
}