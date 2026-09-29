<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Removes admin-approval fields from flash_sales table.
     * Flash sales are now auto-approved and displayed directly on the homepage.
     */
    public function up(): void
    {
        Schema::table('flash_sales', function (Blueprint $table) {
            $table->dropIndex('flash_sales_status_start_time_end_time_index');
            $table->dropColumn(['status', 'rejection_reason']);
        });

        // Add new index without status column
        Schema::table('flash_sales', function (Blueprint $table) {
            $table->index(['start_time', 'end_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flash_sales', function (Blueprint $table) {
            $table->dropIndex('flash_sales_start_time_end_time_index');
            $table->string('status')->default('active');
            $table->text('rejection_reason')->nullable();
            $table->index(['status', 'start_time', 'end_time']);
        });
    }
};
