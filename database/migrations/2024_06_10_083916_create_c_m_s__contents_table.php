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
        Schema::create('c_m_s__contents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('image_url')->nullable();
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('c_m_s__contents')->insert([
            // Banner
            ['title' => 'Why Cars & Bids?', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'logo', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'twitter', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'facebook', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'instagram', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'git', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Smart Car Auctions', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Heavyxxx@Gmail.Com', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_m_s__contents');
    }
};
