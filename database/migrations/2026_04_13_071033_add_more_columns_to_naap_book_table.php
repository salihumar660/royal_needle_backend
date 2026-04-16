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
            $table->string('arm_hole')->nullable()->after('trouser_length');
            $table->string('back_width')->nullable()->after('arm_hole');
            $table->string('coat_length')->nullable()->after('back_width');
            $table->string('collar_type')->nullable()->after('coat_length');
            $table->string('shalwar_pancha')->nullable()->after('collar_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('naap_book', function (Blueprint $table) {
            $table->dropColumn([
                'arm_hole',
                'back_width',
                'coat_length',
                'collar_type',
                'shalwar_pancha'
            ]);
        });
    }
};
