<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->enum('status', ['pending', 'success'])->default('pending');

            $table->string('account_number');
            $table->string('routing_number');
            $table->string('account_name');
            $table->string('bank_name');
            $table->string('branch_name'); 
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country');
            $table->decimal('amount', 12, 2)->default(0); // Adjust precision and scale as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
