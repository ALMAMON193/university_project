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
        Schema::create('dynamic_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_title');
            $table->string('page_slug');
            $table->longText('page_content')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('dynamic_pages')->insert([
            // Banner
            ['page_title' => 'Community', 'page_slug'=>'community', 'created_at' => now(), 'updated_at' => now()],                                  
            ['page_title' => 'Support','page_slug'=>'support', 'created_at' => now(), 'updated_at' => now()],                 
            ['page_title' => 'Shipping','page_slug'=>'shipping', 'created_at' => now(), 'updated_at' => now()],                 
            ['page_title' => 'Shop C&B Merch','page_slug'=>'shop_c&b_merch', 'created_at' => now(), 'updated_at' => now()],                 
            ['page_title' => 'Careers','page_slug'=>'careers', 'created_at' => now(), 'updated_at' => now()],                 
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dynamic_pages');
    }
};
