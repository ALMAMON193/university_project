<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars__and__bids', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default rows
        DB::table('cars__and__bids')->insert([
            // about part
            ['title' => 'About', 'created_at' => now(), 'updated_at' => now()],

            // features
            ['title' => 'Cool Car Auctions', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Low Fees', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'More Information', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Easy to Use', 'created_at' => now(), 'updated_at' => now()],

            // profile
            ['title' => 'Saudi Cars Hubs', 'created_at' => now(), 'updated_at' => now()],


            // how it works part
            ['title' => 'Buying a Car', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Selling a Car', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Finalizing the Sale', 'created_at' => now(), 'updated_at' => now()],

            // Heor text
            ['title' => 'Heor', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars__and__bids');
    }
};
