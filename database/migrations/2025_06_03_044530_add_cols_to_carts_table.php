<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('coupon_code')->after('shipping_method')->nullable();
            $table->string('discount_value')->after('tax_total')->nullable();
            $table->string('discount_type')->after('tax_total')->nullable();
            $table->string('discount_code')->after('tax_total')->nullable();
            $table->unsignedBigInteger('discount_id')->after('tax_total')->nullable();
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('discount_value')->after('tax_amount')->nullable();
            $table->string('discount_type')->after('tax_amount')->nullable();
            $table->string('discount_code')->after('tax_amount')->nullable();
            $table->unsignedBigInteger('discount_id')->after('tax_amount')->nullable();
            $table->double('discount_percent')->after('tax_amount')->default(0);
            $table->double('discount_amount')->after('tax_amount')->default(0);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('discount_value')->after('total_qty')->nullable();
            $table->string('discount_type')->after('total_qty')->nullable();
            $table->string('discount_code')->after('total_qty')->nullable();
            $table->unsignedBigInteger('discount_id')->after('total_qty')->nullable();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->string('discount_value')->after('tax_amount')->nullable();
            $table->string('discount_type')->after('tax_amount')->nullable();
            $table->string('discount_code')->after('tax_amount')->nullable();
            $table->unsignedBigInteger('discount_id')->after('tax_amount')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('discount_value');
            $table->dropColumn('discount_type');
            $table->dropColumn('discount_code');
            $table->dropColumn('discount_id');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('discount_value');
            $table->dropColumn('discount_type');
            $table->dropColumn('discount_code');
            $table->dropColumn('discount_id');
            $table->dropColumn('discount_percent');
            $table->dropColumn('discount_amount');

        });


        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('discount_value');
            $table->dropColumn('discount_type');
            $table->dropColumn('discount_code');
            $table->dropColumn('discount_id');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('discount_value');
            $table->dropColumn('discount_type');
            $table->dropColumn('discount_code');
            $table->dropColumn('discount_id');
            $table->dropColumn('discount_percent');
            $table->dropColumn('discount_amount');

        });
    }
};
