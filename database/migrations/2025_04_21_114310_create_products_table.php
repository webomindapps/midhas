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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sku');
            $table->string('slug');
            $table->string('upc_code')->nullable();
            $table->string('brand_id')->nullable();
            $table->tinyInteger('order_type')->default(1);

            $table->double('selling_price')->default(0);
            $table->double('msrp')->default(0);
            $table->double('instore_price')->default(0);
            $table->double('rebate')->default(0);

            $table->string('thumbnail')->nullable();

            $table->bigInteger('total_stock')->default(0);

            $table->text('product_details')->nullable();
            $table->text('product_description')->nullable();
            $table->text('payment_security')->nullable();
            $table->boolean('is_featured')->default(false); // 1 = featured, 0 = not featured
            $table->boolean('is_new')->default(false); // 1 = new, 0 = not new
            $table->boolean('is_best_selling')->default(false); // 1 = best selling, 0 = not best selling
            $table->boolean('is_taxable')->default(false); // 1 = taxable, 0 = not taxable
            $table->boolean('is_outof_stock')->default(false); 
            $table->boolean('is_comming')->default(false); 
            $table->boolean('status')->default(true); // 1 = active, 0 = inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
