<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('mangas', function (Blueprint $table) {
        $table->id();
        $table->string('manga_id')->unique(); // id asli dari Mangadex
        $table->string('title');
        $table->string('type')->nullable();
        $table->string('cover_file')->nullable(); // fileName dari cover_art
        $table->timestamps();
    });
}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mangas');
    }
};
