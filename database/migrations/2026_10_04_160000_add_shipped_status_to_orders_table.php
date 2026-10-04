<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds the missing "shipped" step so an order can be in transit without
     * already being "processing". On MySQL this becomes MODIFY ENUM; on SQLite
     * the enum is a check constraint and Laravel rebuilds the table.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])
                ->default('pending')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Orders that were moved to "shipped" must be moved back to "delivered"
     * or "processing" first, as the value no longer exists.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'processing', 'delivered', 'cancelled'])
                ->default('pending')
                ->change();
        });
    }
};
