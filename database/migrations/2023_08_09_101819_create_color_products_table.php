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
        Schema::create('color_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('color_id')
                ->index()
                ->nullable()
                ->constrained('colors')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->index()
                ->nullable()
                ->constrained('products')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_products');
    }
};
