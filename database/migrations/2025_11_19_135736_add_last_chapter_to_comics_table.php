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
    Schema::table('comics', function (Blueprint $table) {
        $table->string('last_chapter')->nullable()->after('last_update');
    });
}

public function down()
{
    Schema::table('comics', function (Blueprint $table) {
        $table->dropColumn('last_chapter');
    });
}

};
