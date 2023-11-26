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
        Schema::create('contact_and_socials', function (Blueprint $table) {
            $table->id();
            $table->string('phone_one')->nullable();
            $table->string('phone_two')->nullable();
            $table->string('email_one')->nullable();
            $table->string('email_two')->nullable();
            $table->string('address')->nullable();
            $table->string('map_link')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('status')->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_and_socials');
    }
};
