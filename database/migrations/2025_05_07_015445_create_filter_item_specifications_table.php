<?php

use App\Models\FilterItem;
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
        Schema::create('filter_item_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FilterItem::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('specification_id')->nullable();
            $table->string('specification_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filter_item_specifications');
    }
};
