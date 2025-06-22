<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['approve', 'disapprove', 'pending', 'close'])->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // show to the feature section or not
            $table->boolean('featured')->default(false);

            $table->string('full_name');
            $table->string('phone');
            $table->string('vin_number');
            $table->integer('year');
            $table->string('make');
            $table->string('model');

            $table->string('transmission');
            $table->integer('mileage');
            $table->string('equipment'); // equipment with the car
            $table->boolean('modify')->default(false); // is there any modification
            $table->text('modify_text')->nullable(); // describe the modifications
            $table->boolean('flaw')->default(false); // does the car have flaw?
            $table->text('flaw_text')->nullable(); // what flaw describe
            $table->string('location');
            $table->boolean('sale_elsewhere')->default(false);
            $table->string('titled_location');
            $table->unsignedBigInteger('state_id')->default(1); // state id from the state table
            $table->foreign('state_id')->references('id')->on('states');

            $table->boolean('on_my_name')->default(true); // does this car registered on my name
            $table->string('title_status'); // car title status

            $table->boolean('reserve_price')->default(false); // do I want to set a reserve price
            $table->string('price_range')->nullable(); // if I want set a price range
            $table->dateTime('start')->nullable(); // auction start time
            $table->dateTime('end')->nullable(); // auction end time

            $table->string('engine');
            $table->string('drivetrain');
            $table->string('body_style');
            $table->string('exterior_color');
            $table->string('interior_color');
            $table->text('ownership_history');

            $table->softDeletes(); // Adds the deleted_at column for soft delete

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
