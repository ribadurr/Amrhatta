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
        if (!Schema::hasColumn('members', 'coach_id')) {
            Schema::table('members', function (Blueprint $table) {
                $table->foreignId('coach_id')->nullable()->constrained('coaches')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('members', 'coach_id')) {
            Schema::table('members', function (Blueprint $table) {
                $table->dropForeign(['coach_id']);
                $table->dropColumn('coach_id');
            });
        }
    }
};
