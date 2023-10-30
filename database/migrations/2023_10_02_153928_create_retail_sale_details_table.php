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
        Schema::create('retail_sale_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('retail_sales_id');
            $table->unsignedBigInteger('products_id');
            $table->integer('p_quantity');
            $table->integer('p_price');
            $table->integer('del_flg')->default(0);
            $table->foreign('retail_sales_id')->references('id')->on('retail_sales');
            $table->foreign('products_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_sale_details');
    }
};
