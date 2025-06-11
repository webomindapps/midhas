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
        Schema::table('carts', function (Blueprint $table) {
            $table->string('type')->nullable()->after('grand_total');
            $table->date('date')->nullable()->after('type');
            $table->string('time')->nullable()->after('date');
            $table->double('price')->nullable()->after('time');
            $table->double('min_price')->nullable()->after('price');
            $table->string('city')->nullable()->after('min_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('date');
            $table->dropColumn('time');
            $table->dropColumn('price');
            $table->dropColumn('min_price');
            $table->dropColumn('city');
        });
    }
};
