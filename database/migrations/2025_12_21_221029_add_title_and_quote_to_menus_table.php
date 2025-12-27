<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            // Judul menu (English)
            $table->string('title');

            // Kutipan / tagline (English)
            $table->string('quote')->nullable();

            // Nama menu
            $table->string('name');

            // Deskripsi menu
            $table->text('description')->nullable();

            // Gambar menu
            $table->string('image')->nullable();

            // Harga
            $table->decimal('price', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
