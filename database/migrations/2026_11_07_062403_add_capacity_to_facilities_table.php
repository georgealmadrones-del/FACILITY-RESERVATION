<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('facilities', 'capacity')) {
            Schema::table('facilities', function (Blueprint $table) {
                $table->integer('capacity')->default(30)->after('description');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('facilities', 'capacity')) {
            Schema::table('facilities', function (Blueprint $table) {
                $table->dropColumn('capacity');
            });
        }
    }
};