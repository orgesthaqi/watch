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
        Schema::table('media_items', function (Blueprint $table) {
            $table->enum('type', [1, 2])->after('views');
            $table->unsignedBigInteger('serie_id')->nullable()->after('type');
            $table->unsignedInteger('episode_number')->nullable()->after('serie_id');
            $table->unsignedInteger('season_number')->nullable()->after('episode_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media_items', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('serie_id');
            $table->dropColumn('episode_number');
            $table->dropColumn('season_number');
        });
    }
};
