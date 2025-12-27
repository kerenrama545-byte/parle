<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->decimal('price', 12, 2)->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->string('quote')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->decimal('price', 12, 2)->nullable(false)->change();
        });
    }
};
