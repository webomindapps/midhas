<?php

use App\Models\Filter;
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
        Schema::create('filter_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Filter::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedBigInteger('position')->default(1);
            $table->string('type')->default('checkbox');
            $table->string('column_name')->nullable();
            $table->boolean('is_specification')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filter_items');
    }
};
