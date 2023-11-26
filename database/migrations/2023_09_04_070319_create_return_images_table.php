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
        Schema::create('return_images', function (Blueprint $table) {
            $table->id();
            $table->string('return_id')->nullable();
            $table->string('return_images')->nullable();
            $table->foreign('return_id')->references('id')->on('product_returns')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_images');
    }
};
