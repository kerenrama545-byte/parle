<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('featured_menus', function (Blueprint $table) {
            $table->id();
            $table->string('quote')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('featured_menus');
    }
};
