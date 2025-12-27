<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('quote')->nullable(); // bisa null
            $table->text('description')->nullable(); // bisa null, untuk paragraf
            $table->text('opening_hours_description')->nullable(); // bisa null
            $table->text('image_1')->nullable(); // optional image 1
            $table->text('image_2')->nullable(); // optional image 2
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
