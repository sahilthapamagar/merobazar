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
        Schema::table('product_varients', function (Blueprint $table) {
            if (! Schema::hasColumn('product_varients', 'stock')) {
                $table->integer('stock')->default(0)->after('price');
            }
            if (! Schema::hasColumn('product_varients', 'compare_price')) {
                $table->double('compare_price')->nullable()->after('price');
            }
            if (! Schema::hasColumn('product_varients', 'name')) {
                $table->string('name')->nullable()->after('title');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_varients', function (Blueprint $table) {
            $table->dropColumn(['stock', 'compare_price', 'name']);
        });
    }
};
