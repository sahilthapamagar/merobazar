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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('khalti_secrect_key')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending','rejected'])->default('pending');
            $table->date('expired_date')->nullable();
            $table->string('contact')->nullable();
            $table->string('citizenship_photo')->nullable();
            $table->string('image')->nullable();
            $table->string('rejected_reason')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
