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
        Schema::create('slide_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slide_id');
            $table->json('content')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('slide_id')->references('id')->on('slides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide_items');
    }
};
