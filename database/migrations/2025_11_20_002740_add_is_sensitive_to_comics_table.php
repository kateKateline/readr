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
        $table->boolean('is_sensitive')
              ->default(false)
              ->after('status');
    });
}

public function down()
{
    Schema::table('comics', function (Blueprint $table) {
        $table->dropColumn('is_sensitive');
    });
}

};
