<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indexes', function (Blueprint $table) {
            $table->id();
            $table->string('quote');
            $table->text('description_1');
            $table->text('description_2');
            $table->string('bg_img');
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indexes');
    }
};
