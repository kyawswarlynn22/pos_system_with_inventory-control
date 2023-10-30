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
        Schema::create('preorder_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preorder_sales_id');
            $table->unsignedBigInteger('products_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('del_flg')->default(0);
            $table->foreign('preorder_sales_id')->references('id')->on('preorder_sales');
            $table->foreign('products_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preorder_details');
    }
};
