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
        Schema::create('company_information', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->json('phones')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('google_map_link')->nullable();
            $table->json('opening_hours')->nullable();
            $table->string('video_profile_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_information');
    }
};
