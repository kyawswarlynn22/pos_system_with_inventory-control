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
            $table->string('product_name',256);
            $table->string('p_code',128);
            $table->unsignedBigInteger('categories_id');
            $table->unsignedBigInteger('sub_catgories_id');
            $table->string('p_one',256);
            $table->string('p_two',256)->nullable();
            $table->string('p_three',256)->nullable();
            $table->string('p_four',256)->nullable();
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('stock_confrim');
            $table->string('description',256);
            $table->integer('del_flg')->default(0);
            $table->timestamps();
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('sub_catgories_id')->references('id')->on('sub_categories');
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
