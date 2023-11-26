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
        Schema::create('employs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nid')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('salary')->nullable();
            $table->string('status')->default('active');
            // $table->foreign('role_id')->references('id')->on('employ_roles')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('employ_roles')->onDelete('cascade');
            $table->timestamps();
        });
    }
    // 2023_09_22_141322_create_employs_table

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employs');
    }
};
