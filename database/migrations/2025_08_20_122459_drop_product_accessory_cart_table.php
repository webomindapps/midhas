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
        Schema::dropIfExists('product_accessory_cart');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('product_accessory_cart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_item_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('accessory_id');
            $table->string('accessory_name');
            $table->string('accessory_price');
            $table->timestamps();
        });
    }
};
