<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            if (Schema::hasColumn('coaches', 'experience_years')) {
                $table->dropColumn('experience_years');
            }
            if (!Schema::hasColumn('coaches', 'nip')) {
                $table->string('nip')->nullable()->after('position');
            }
        });
    }

    public function down(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            if (Schema::hasColumn('coaches', 'nip')) {
                $table->dropColumn('nip');
            }
            if (!Schema::hasColumn('coaches', 'experience_years')) {
                $table->integer('experience_years')->nullable();
            }
        });
    }
};