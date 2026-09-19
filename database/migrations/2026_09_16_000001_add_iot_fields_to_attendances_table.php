<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('athlete_id')->nullable()->after('id')->constrained('athletes')->nullOnDelete();
            $table->unsignedSmallInteger('heart_rate')->nullable()->after('athlete_id');
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['athlete_id']);
            $table->dropColumn(['athlete_id', 'heart_rate']);
        });
    }
};