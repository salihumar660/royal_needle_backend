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
        Schema::table('naap_book', function (Blueprint $table) {
            $table->string('quantity')->default(1)->after('shalwar_pancha');
            $table->date('measurement_date')->nullable()->after('quantity');
            $table->date('delivery_date')->nullable()->after('measurement_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('naap_book', function (Blueprint $table) {
            $table->dropColumn([
                'quantity',
                'measurement_date',
                'delivery_date'
            ]);
        });
    }
};