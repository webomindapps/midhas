<?php

use App\Models\Invoice;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Invoice::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->nullable();

            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->string('upc_code')->nullable();
            $table->string('brand_id')->nullable();
            $table->double('price')->default(0);
            $table->integer('qty')->default(1);

            $table->unsignedBigInteger('product_warranty_id')->nullable();
            $table->string('protection_plan_name')->nullable();
            $table->string('protection_plan_no_of_months')->nullable();

            $table->double('sub_total')->default(0);

            $table->double('tax_percent')->default(0);
            $table->double('tax_amount')->default(0);

            $table->double('discount_percent')->default(0);

            $table->unsignedBigInteger('discount_id')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('discount_value')->nullable();

            $table->double('discount_amount')->default(0);

            $table->double('protection_plan_price')->default(0);

            $table->double('grand_total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
