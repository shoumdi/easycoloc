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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image_id');
        });
        Schema::dropIfExists('images');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->id();
            $table->string("url");
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('image_id');
        });
    }
};
