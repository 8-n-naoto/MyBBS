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
        Schema::create('each_ingredients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('basic_ingredients_id'); //外部キー  basic_ingredients_id
            $table->string('ingredient_name');
            $table->integer('ingredient_amount');
            $table->integer('lot-amount');
            $table->string('lot_unit');
            $table->integer('expiration');
            $table
                ->foreign('basic_ingredients_id')
                ->references('id')
                ->on('basic_ingredients')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('each_ingredients');
    }
};
