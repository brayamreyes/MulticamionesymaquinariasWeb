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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->nullable()->default(null);
            $table->string('code')->nullable()->default(null);
            $table->string('status')->nullable()->default(\App\Concerns\Enums\Status::PENDING->value);

            $table->string('first_name');
            $table->string('last_name');
            $table->string('dni');
            $table->string('ruc');
            $table->string('business_name');
            $table->string('phone');
            $table->string('email');

            $table->boolean('accept_privacy_policy')->default(false);

            $table->longText('terms_conditions')->nullable()->default(null);
            $table->longText('way_to_pay')->nullable()->default(null);
            $table->longText('delivery_term')->nullable()->default(null);

            $table->unsignedInteger('product_id');

            $table->double('exchange', 8, 2)->nullable()->default(0);
            $table->double('dollar_price', 8, 2)->nullable()->default(0);
            $table->double('pen_price', 8, 2)->nullable()->default(0);

            $table->double('dollar_igv', 8, 2)->nullable()->default(0);
            $table->double('pen_igv', 8, 2)->nullable()->default(0);

            $table->double('dollar_final_price', 8, 2)->nullable()->default(0);
            $table->double('pen_final_price', 8, 2)->nullable()->default(0);

            $table->string('product_name')->nullable()->default(null);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
