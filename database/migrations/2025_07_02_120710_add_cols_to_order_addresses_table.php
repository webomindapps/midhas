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
        Schema::table('order_addresses', function (Blueprint $table) {
              $table->unsignedBigInteger('customer_id')->after('order_id');
            $table->foreign('customer_id')->references('id')->on('users');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_addresses', function (Blueprint $table) {
            $table->dropColumn('customer_id');
        });
    }
};
