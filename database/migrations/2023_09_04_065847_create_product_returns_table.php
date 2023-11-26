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
        Schema::create('product_returns', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('return_reson_id')->nullable();
            $table->string('user_note')->nullable();
            $table->string('admin_note')->nullable();
            $table->string('process_date')->nullable();
            $table->string('accept_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('reject_date')->nullable();
            $table->string('return_charge')->nullable();
            $table->enum('status',['process','accept','deliverd','reject'])->default('process');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_returns');
    }
};
