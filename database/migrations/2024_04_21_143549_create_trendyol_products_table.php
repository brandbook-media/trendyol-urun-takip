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
        Schema::create('trendyol_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trendyol_id');
            $table->foreignId('trendyol_category_id');
            $table->string('name');
            $table->string('description');
            $table->string('url');
            $table->string('price');
            $table->string('brand');
            $table->string('image');
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trendyol_products');
    }
};
