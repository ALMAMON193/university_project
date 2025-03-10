<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sell__car__pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });


        // Insert default rows
        DB::table('sell__car__pages')->insert([
            // Heor text
            ['title' => 'Heor', 'created_at' => now(), 'updated_at' => now()],
            
            // Our Auctions
            ['title' => 'Reserve Auction', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'No Reserve Auction', 'created_at' => now(), 'updated_at' => now()],
        
            // how it works
            ['title' => 'step one', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'step two', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'step three', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'step four', 'created_at' => now(), 'updated_at' => now()],

            // advantages
            ['title' => 'Hero two', 'created_at' => now(), 'updated_at' => now()],

            ['title' => 'Live Support', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Sell Faster', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Easy Access', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Sell for Free', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell__car__pages');
    }
};
