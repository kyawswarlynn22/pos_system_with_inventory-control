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
        Schema::create('retail_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customers_id');
            $table->string('pur_date');
            $table->integer('discount');
            $table->integer('grand_total');
            $table->string('remark',256);
            $table->string('del_flg')->default(0);
            $table->timestamps();
            $table->foreign('customers_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_sales');
    }
};
