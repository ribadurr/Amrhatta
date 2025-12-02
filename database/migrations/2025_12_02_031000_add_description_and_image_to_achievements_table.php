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
            if (!Schema::hasColumn('achievements', 'description')) {
                $table->text('description')->nullable()->after('category');
            }
            if (!Schema::hasColumn('achievements', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            if (Schema::hasColumn('achievements', 'image')) {
                $table->dropColumn('image');
            }
            if (Schema::hasColumn('achievements', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
