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
        Schema::table('sellers', function (Blueprint $table) {
            if (Schema::hasColumn('sellers', 'registration_number') && !Schema::hasColumn('sellers', 'pan_number')) {
                $table->renameColumn('registration_number', 'pan_number');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            if (Schema::hasColumn('sellers', 'pan_number') && !Schema::hasColumn('sellers', 'registration_number')) {
                $table->renameColumn('pan_number', 'registration_number');
            }
        });
    }
};
