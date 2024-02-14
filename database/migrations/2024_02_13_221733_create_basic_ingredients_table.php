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
        Schema::create('basic_ingredients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('cake_infos_id'); //外部キー  cake_infos
            $table->string('basic_amount');
            $table->string('ingredient_unit');
            $table
                ->foreign('cake_infos_id')
                ->references('id')
                ->on('cake_infos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_ingredients');
    }
};
