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
        Schema::create('deposit_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customers_id');
            $table->string('pur_date',128);
            $table->integer('discount')->nullable();
            $table->integer('grand_total');
            $table->integer('deposit')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('paid')->nullable();
            $table->string('remark',256)->nullable();
            $table->integer('del_flg')->default(0);
            $table->timestamps();
            $table->foreign('customers_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_sales');
    }
};
