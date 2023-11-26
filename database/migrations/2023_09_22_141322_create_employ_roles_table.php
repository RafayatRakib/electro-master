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
        Schema::create('employ_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role')->nullable();
            $table->string('salary')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }
    // 2023_09_22_150858_create_employ_roles_table
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employ_roles');
    }
};
