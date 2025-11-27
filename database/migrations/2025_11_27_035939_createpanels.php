<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapter_panels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained()->onDelete('cascade');
            $table->integer('page_number');          // halaman ke berapa
            $table->string('image_url');             // direct CDN MangaDex image
            $table->timestamps();

            $table->unique(['chapter_id', 'page_number']); // 1 halaman hanya 1 gambar
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapter_panels');
    }
};
