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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('manager_name');
            $table->string('location');

            $table->text('address')->nullable();
            $table->text('map_link')->nullable();
            $table->text('working_hours')->nullable();

            $table->text('video')->nullable();
            $table->text('video_link')->nullable();
            $table->string('store_image')->nullable();
            $table->text('store_image_link')->nullable();

            $table->text('customer_care')->nullable();
            $table->text('delivery_enquiries')->nullable();
            $table->text('sales_info')->nullable();

            $table->integer('position')->default(1);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
