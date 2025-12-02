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
        Schema::table('achievements', function (Blueprint $table) {
            if (!Schema::hasColumn('achievements', 'member_id')) {
                $table->foreignId('member_id')->nullable()->after('category')->constrained()->onDelete('set null');
            }
            if (!Schema::hasColumn('achievements', 'event_id')) {
                $table->foreignId('event_id')->nullable()->after('member_id')->constrained()->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            if (Schema::hasColumn('achievements', 'event_id')) {
                $table->dropForeign(["event_id"]);
                $table->dropColumn('event_id');
            }
            if (Schema::hasColumn('achievements', 'member_id')) {
                $table->dropForeign(["member_id"]);
                $table->dropColumn('member_id');
            }
        });
    }
};
