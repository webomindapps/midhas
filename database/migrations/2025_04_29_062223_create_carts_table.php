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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('shipping_method')->nullable();
            $table->integer('items_count')->default(0);
            $table->integer('items_qty')->default(0);
            $table->double('tax')->default(0);
            $table->double('total_amount')->default(0);
            $table->double('tax_total')->default(0);
            $table->double('discount_amount')->default(0);
            $table->double('grand_total')->default(0);
            $table->string('plans')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
