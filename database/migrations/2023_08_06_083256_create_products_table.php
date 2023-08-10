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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->unsignedBigInteger('quantity')->nullable();
            $table->unsignedFloat('price')->nullable();
            $table->text('description')->nullable();
            $table->text('additional')->nullable();

            $table->foreignId('category_id')
                ->index()
                ->nullable()
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
