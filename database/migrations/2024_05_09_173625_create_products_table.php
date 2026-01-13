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
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->string('plate')->nullable()->default(null);
            $table->string('bin')->nullable()->default(null);
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('model')->nullable()->default(null);
            $table->string('year_model')->nullable()->default(null);
            $table->string('year_manufacture')->nullable()->default(null);
            $table->string('mileage')->nullable()->default(null);
            $table->string('hours')->nullable()->default(null);
            $table->string('power')->nullable()->default(null);

            $table->decimal('dollar_price')->nullable()->default(0);
            $table->decimal('pen_price')->nullable()->default(0);

            $table->decimal('dollar_igv')->nullable()->default(0);
            $table->decimal('pen_igv')->nullable()->default(0);

            $table->decimal('dollar_final_price')->nullable()->default(0);
            $table->decimal('pen_final_price')->nullable()->default(0);

            $table->string('image_1')->nullable()->default(null);
            $table->string('image_2')->nullable()->default(null);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->json('content')->nullable()->default(null);
            $table->string('data_sheet')->nullable()->default(null);
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
