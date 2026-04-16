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
        
        //drop to_pay
        if(Schema::hasColumn('order', 'to_pay')) {
            $table->dropColumn('to_pay');
        }
        //drop due
        if(Schema::hasColumn('order', 'due')) {
            $table->dropColumn('due');
        }
        //drop paid
        if(Schema::hasColumn('order', 'paid')) {
            $table->dropColumn('paid');
        }
        //drop discount
        if(Schema::hasColumn('order', 'discount')) {
            $table->dropColumn('discount');
        }
        });
        //add Schema
        Schema::table('order', function (Blueprint $table) {
            //add original amount
            if(!Schema::hasColumn('order', 'original_amount')) {
                $table->decimal('original_amount', 8, 2)->default(0);
            }
            //add paid amount
            if(!Schema::hasColumn('order', 'paid_amount')) {
                $table->decimal('paid_amount', 8, 2)->default(0);
            }
            //add discount amount
            if(!Schema::hasColumn('order', 'discount_amount')) {
                $table->decimal('discount_amount', 8, 2)->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order', function (Blueprint $table) {
            $table->decimal('to_pay', 10, 2)->nullable();
            $table->decimal('due', 10, 2)->nullable();
            $table->decimal('paid', 10, 2)->nullable();
            $table->boolean('discount')->default(false);
        });
    }
};
