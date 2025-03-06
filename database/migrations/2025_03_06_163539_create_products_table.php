<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('sort');
            $table->unsignedInteger('price')->default(0);
            $table->string('title');
            $table->string('slug');
            $table->jsonb('picture_image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');
            $table->unique([ 'category_id', 'product_id' ]);
        });

        Schema::create('characteristic_product_value', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_characteristic_id')->constrained('category_characteristic')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_product_id')->constrained('category_product')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique([ 'category_characteristic_id', 'category_product_id' ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('characteristic_product_value');
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('products');
    }
};
