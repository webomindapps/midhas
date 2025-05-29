<?php

use App\Models\User;
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
        Schema::create('product_enquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();

            $table->foreignIdFor(Product::class);
            $table->string('product_name');
            $table->string('sku');
            $table->string('brand')->nullable();

            $table->string('name');
            $table->string('phone');
            $table->text('message');

            $table->boolean('status')->default(true);

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_enquiries');
    }
};
