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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('dollar_price', 15)->nullable()->default(0)->change();
            $table->decimal('pen_price', 15)->nullable()->default(0)->change();

            $table->decimal('dollar_igv', 15)->nullable()->default(0)->change();
            $table->decimal('pen_igv', 15)->nullable()->default(0)->change();

            $table->decimal('dollar_final_price', 15)->nullable()->default(0)->change();
            $table->decimal('pen_final_price', 15)->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('dollar_price')->nullable()->default(0)->change();
            $table->decimal('pen_price')->nullable()->default(0)->change();

            $table->decimal('dollar_igv')->nullable()->default(0)->change();
            $table->decimal('pen_igv')->nullable()->default(0)->change();

            $table->decimal('dollar_final_price')->nullable()->default(0)->change();
            $table->decimal('pen_final_price')->nullable()->default(0)->change();
        });
    }
};
