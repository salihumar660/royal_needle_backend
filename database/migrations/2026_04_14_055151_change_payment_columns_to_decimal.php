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
        Schema::table('order', function (Blueprint $table) {
            $table->decimal('to_pay', 10, 2)->change();
            $table->decimal('paid', 10, 2)->change();
            $table->decimal('due', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order', function (Blueprint $table) {
            $table->string('to_pay')->change();
            $table->string('paid')->change();
            $table->string('due')->change();
        });
    }
};
