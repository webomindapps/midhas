<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();

            $table->string('name')->nullable();
            $table->string('email')->nullable();

            $table->string('order_type')->nullable();
            $table->date('order_date')->nullable();

            $table->integer('total_items')->default(1);
            $table->integer('total_qty')->default(1);

            $table->double('discount_amount')->default(0);
            $table->double('sub_total')->default(0);
            $table->double('tax_total')->default(0);
            $table->double('grand_total')->default(0);

            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
