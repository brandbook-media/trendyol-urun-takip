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
        Schema::create('trendyol_product_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trendyol_product_id');
            $table->unsignedBigInteger('comment_count');
            $table->unsignedBigInteger('product_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trendyol_product_histories');
    }
};
