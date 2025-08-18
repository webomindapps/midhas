<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('product_accessories', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['name', 'price']);

            // Add new columns
            $table->string('accessory_name')->after('product_id');
            $table->unsignedBigInteger('accessory_category_id')->nullable()->after('accessory_name');
            $table->unsignedBigInteger('accesory_product_id')->nullable()->after('accessory_category_id');
            $table->string('sku')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('product_accessories', function (Blueprint $table) {
            // Rollback: drop new columns
            $table->dropColumn([ 'accessory_category_id', 'accesory_product_id', 'sku']);

            // Re-add old columns
            $table->string('name');
            $table->bigInteger('price');
        });
    }
};
