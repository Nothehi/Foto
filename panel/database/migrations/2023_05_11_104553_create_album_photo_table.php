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
        Schema::create('album_photo', function (Blueprint $table) {
            $table->foreignId('album_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('photo_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->primary(['album_id', 'photo_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_photo');
    }
};
