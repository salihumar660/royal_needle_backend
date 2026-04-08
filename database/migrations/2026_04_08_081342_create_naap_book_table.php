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
        Schema::create('naap_book', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('chest')->nullable();
            $table->string('waist')->nullable();
            $table->string('hips')->nullable();
            $table->string('shoulder')->nullable();
            $table->string('sleeveLength')->nullable();
            $table->string('wrist')->nullable();
            $table->string('thigh')->nullable();
            $table->string('shirt_length')->nullable();
            $table->string('trouser_length')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('tehsil_id')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naap_book');
    }
};
