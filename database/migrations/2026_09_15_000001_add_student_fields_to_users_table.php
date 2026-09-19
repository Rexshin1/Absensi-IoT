<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim', 50)->nullable()->unique()->after('name');
            $table->string('prodi', 150)->nullable()->after('nim');
            $table->string('fakultas', 150)->nullable()->after('prodi');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['nim']);
            $table->dropColumn(['nim', 'prodi', 'fakultas']);
        });
    }
};