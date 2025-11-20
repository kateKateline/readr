<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('global_chats', function (Blueprint $table) {
            $table->id();
            // Karena users.id = int unsigned, kita harus samakan
            $table->unsignedInteger('user_id')->nullable();
            $table->text('message');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('global_chats');
    }
};
