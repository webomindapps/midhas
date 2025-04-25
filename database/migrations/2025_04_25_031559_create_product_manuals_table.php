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
        Schema::create('product_manuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Foreign key for product
            $table->string('name'); // Manual label
            $table->string('uploaded_file')->nullable(); // File path or URL for the uploaded file
            $table->string('file_link')->nullable(); // External link to the manual (optional)
            $table->timestamps();

            // Optionally, add a foreign key constraint if you want to link it to the products table
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_manuals');
    }
};
