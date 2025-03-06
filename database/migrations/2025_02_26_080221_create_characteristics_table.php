<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Characteristic;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            $table->nestedSet(); // Добавляет поля _lft, _rgt, parent_id
            $table->boolean('smart')->default(false);
            $table->unsignedInteger('sort')->default(100);
            $table->string('title');
            $table->integer('type')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('category_characteristic', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Characteristic::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique([ 'category_id', 'characteristic_id' ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characteristics');
    }
};
