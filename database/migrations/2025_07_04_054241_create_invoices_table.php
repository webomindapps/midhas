<?php

use App\Models\Orders;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Orders::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->nullable();

            $table->string('name')->nullable();
            $table->string('email')->nullable();

            $table->string('order_type')->nullable();
            $table->date('order_date')->nullable();

            $table->integer('total_items')->default(1);
            $table->integer('total_qty')->default(1);

            $table->unsignedBigInteger('discount_id')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('discount_value')->nullable();

            $table->double('discount_amount')->default(0);

            $table->unsignedBigInteger('deliver_id')->nullable();
            $table->string('deliver_type')->nullable();
            $table->string('deliver_location_name')->nullable();
            $table->double('deliver_amount')->default(0);

            $table->double('sub_total')->default(0);
            $table->double('protection_plan_total')->default(0);
            $table->double('tax_total')->default(0);
            $table->double('grand_total')->default(0);

            $table->string('status')->default('pending');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
