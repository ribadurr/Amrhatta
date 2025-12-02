<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate existing member_id data to the pivot table
        $achievements = DB::table('achievements')
            ->whereNotNull('member_id')
            ->get();

        foreach ($achievements as $achievement) {
            DB::table('achievement_member')->insertOrIgnore([
                'achievement_id' => $achievement->id,
                'member_id' => $achievement->member_id,
                'created_at' => $achievement->created_at,
                'updated_at' => $achievement->updated_at,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Clear the pivot table data
        DB::table('achievement_member')->truncate();
    }
};
