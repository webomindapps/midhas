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
        Schema::table('products', function (Blueprint $table) {
            // product filters
            
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('material')->nullable();
            $table->string('style')->nullable();
            $table->integer('no_of_drawers')->nullable();
            $table->integer('no_of_doors')->nullable();
            $table->integer('no_of_hooks')->nullable();
            $table->integer('no_of_shelves')->nullable();
            $table->string('assembly')->nullable();
            $table->string('upholstery_material')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
