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
        Schema::table('product_accessory_cart', function (Blueprint $table) {
            $table->integer('accesory_qty')->default(0)->after('accessory_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_accessory_cart', function (Blueprint $table) {
            $table->dropColumn('accesory_qty');
        });
    }
};
