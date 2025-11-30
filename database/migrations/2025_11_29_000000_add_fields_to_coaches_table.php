<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            if (!Schema::hasColumn('coaches', 'experience_years')) {
                $table->integer('experience_years')->nullable()->after('position');
            }
            if (!Schema::hasColumn('coaches', 'bio')) {
                $table->text('bio')->nullable()->after('experience_years');
            }
            if (!Schema::hasColumn('coaches', 'photo')) {
                $table->string('photo')->nullable()->after('bio');
            }
        });
    }

    public function down(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            if (Schema::hasColumn('coaches', 'photo')) {
                $table->dropColumn('photo');
            }
            if (Schema::hasColumn('coaches', 'bio')) {
                $table->dropColumn('bio');
            }
            if (Schema::hasColumn('coaches', 'experience_years')) {
                $table->dropColumn('experience_years');
            }
        });
    }
};
