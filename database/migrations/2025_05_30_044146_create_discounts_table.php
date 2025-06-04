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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('type')->default(1)->comment('1 dollar 2 percentage');
            $table->double('value')->default(0);
            $table->integer('coupon_type')->default(1)->comment('1 limited 2 unlimited');
            $table->integer('limit')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('applicable_for')->default(1)->comment('1 all products 2 selected products');
            $table->text('sku')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
