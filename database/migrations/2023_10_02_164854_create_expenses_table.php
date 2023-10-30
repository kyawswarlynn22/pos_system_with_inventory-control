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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_categories_id');
            $table->string('description',256)->nullable();
            $table->string('date',256);
            $table->integer('amount');
            $table->string('photo',256)->nullable();
            $table->integer('del_flg')->default(0);
            $table->timestamps();
            $table->foreign('expense_categories_id')->references('id')->on('expense_categories');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
