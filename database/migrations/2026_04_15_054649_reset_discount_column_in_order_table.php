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
            // 1. Drop old column
            if (Schema::hasColumn('order', 'discount')) {
                $table->dropColumn('discount');
            }
            // 2. Add new clean column
            $table->boolean('discount')->default(0)->after('paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
};
