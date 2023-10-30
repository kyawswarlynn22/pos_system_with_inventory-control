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
        Schema::create('sale_return_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_returns_id');
            $table->unsignedBigInteger('products_id');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('del_flg')->default(0);
            $table->timestamps();
            $table->foreign('sale_returns_id')->references('id')->on('sale_returns');
            $table->foreign('products_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_return_details');
    }
};
