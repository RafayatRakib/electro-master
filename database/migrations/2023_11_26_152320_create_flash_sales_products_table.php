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
        Schema::create('flash_sales_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flash_sales_id');
            $table->bigInteger('product_id')->nullable();
            $table->string('discount')->nullable();
            $table->timestamps();
            $table->foreign('flash_sales_id')->references('id')->on('flash_sales')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flash_sales_products');
    }
};
