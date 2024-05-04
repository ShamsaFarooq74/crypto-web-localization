<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('nameEN');
            $table->string('nameAR');
            $table->string('slug')->nullable();
            $table->string('duration');
            $table->string('price');
            $table->string('daily_transfer_amount');
            $table->text('descriptionEN')->nullable();
            $table->text('descriptionAR')->nullable();
            $table->string('currency');
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
