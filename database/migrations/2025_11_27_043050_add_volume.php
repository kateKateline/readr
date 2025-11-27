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

            $table->string('mangadex_id')->unique();
            $table->foreignId('comic_id')->constrained()->onDelete('cascade');

            $table->string('title')->nullable();
            $table->string('chapter_number')->nullable();
            $table->string('volume')->nullable(); // <-- INI YANG BELUM KAMU PUNYA

            $table->timestamp('publish_at')->nullable();
            $table->string('external_url')->nullable();
            $table->boolean('is_unavailable')->default(false);
            $table->timestamp('md_updated_at')->nullable();

            $table->string('hash')->nullable();
            $table->json('data')->nullable();       // full images
            $table->json('data_saver')->nullable(); // data-saver images
            $table->integer('pages')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
