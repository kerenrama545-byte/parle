<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dining_bar_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dining_bar_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dining_bar_images');
    }
};
