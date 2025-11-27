<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();

            // Manga + FK
            $table->uuid('mangadex_id')->unique();
            $table->foreignId('comic_id')->constrained()->onDelete('cascade');

            // Metadata dari MangaDex
            $table->string('title')->nullable();
            $table->string('chapter_number')->nullable();
            $table->string('volume')->nullable();
            $table->string('translated_language', 5)->default('en');
            $table->dateTime('publish_at')->nullable();

            // jumlah halaman (opsional)
            $table->integer('pages')->nullable();

            // Data dari /at-home/server/:chapterId
            $table->string('hash')->nullable();
            $table->json('data')->nullable();        // original quality filenames
            $table->json('data_saver')->nullable();  // compressed quality filenames

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
