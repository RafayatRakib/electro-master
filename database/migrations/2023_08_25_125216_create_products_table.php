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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_slug')->nullable();
            $table->float('purchase_price')->nullable();
            $table->float('product_price')->nullable();
            $table->float('product_discount')->nullable();
            $table->string('product_photo')->nullable();
            $table->bigInteger('qty')->nullable();
            $table->bigInteger('qty_warning')->nullable();
            $table->string('product_code')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->text('short_des')->nullable();
            $table->text('long_des')->nullable();
            $table->text('details')->nullable();
            $table->string('hot_deals')->nullable();
            $table->string('special_offer')->nullable();
            $table->string('featured')->nullable();
            $table->enum('status',['active','inactive'])->default(1);
            $table->timestamps();
            // $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
