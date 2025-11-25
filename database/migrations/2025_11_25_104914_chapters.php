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
        Schema::create('chapters', function (Blueprint $table) {
            // 1. PRIMARY KEY
            $table->id();

            // 2. FOREIGN KEY ke tabel comics
            // Menghubungkan chapter ini dengan komik induknya.
            // Gunakan unsignedBigInteger karena tabel comics memiliki id bigint(20)
            $table->unsignedBigInteger('comic_id'); 
            
            // 3. MangaDex ID untuk Chapter (UNIQUE)
            // Ini adalah ID unik chapter dari API Mangadex.
            $table->string('mangadex_id')->unique(); 

            // 4. Nomor Chapter
            // Digunakan untuk penyortiran (sort chapter 1, 1.5, 2, dll.)
            $table->string('chapter')->nullable()->index(); // Contoh: '12', '12.5', 'ch. 13'
            $table->decimal('chapter_num', 8, 3)->nullable()->index(); // Versi numerik untuk sorting akurat (12.000, 12.500)

            // 5. Judul Chapter (opsional)
            $table->string('title')->nullable();

            // 6. Bahasa Terjemahan
            $table->string('translated_language', 10)->default('en')->index(); // Contoh: 'en', 'id', 'jp'

            // 7. Hash dan Data (untuk pengambilan gambar)
            // Meskipun data ini diambil real-time, menyimpannya untuk caching singkat bisa berguna. 
            // Namun, Mangadex sering mengubah CDN, jadi tidak wajib disimpan.
            // Kita biarkan field ini null dulu, karena fungsi getChapterPages sudah real-time.

            // 8. Tanggal Publish
            $table->timestamp('publish_date')->nullable();

            // 9. Timestamp bawaan Laravel
            $table->timestamps();
            
            // 10. RELASI FOREIGN KEY
            // Jika comic di-delete, semua chapter terkait ikut ter-delete (CASCADE).
            $table->foreign('comic_id')
                  ->references('id')
                  ->on('comics')
                  ->onDelete('cascade');
                  
            // Tambahkan index gabungan untuk efisiensi query saat mencari chapter komik tertentu
            $table->index(['comic_id', 'chapter_num']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};