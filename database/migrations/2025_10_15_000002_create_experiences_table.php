<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ride_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->text('text');
            $table->integer('rating_theme');
            $table->integer('rating_design');
            $table->integer('rating_ridexp');
            $table->integer('rating_guestxp');
            $table->integer('rating_creativity');
            $table->text('image_urls')->nullable();
            $table->boolean('public');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
