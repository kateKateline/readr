<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comic_id')->constrained()->onDelete('cascade');
            $table->string('mangadex_id')->unique();   // ID chapter dari MangaDex
            $table->string('chapter_number')->nullable(); 
            $table->string('title')->nullable();
            $table->string('language')->nullable();     // ex: en, id, jp
            $table->integer('pages')->default(0);        // jumlah panel/gambar
            $table->timestamp('published_at')->nullable(); // tanggal rilis chapter
            $table->timestamps();

            $table->index(['comic_id', 'language']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
