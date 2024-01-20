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
        Schema::create('sub_reservation', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('main_reservation_id');   //外部キー  購入者ヘッダ
            $table->string('cakename');
            $table->string('capacity');
            $table->integer('price');
            $table->text('message');
            $table
                ->foreign('main_reservation_id')
                ->references('id')
                ->on('main_reservation')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_reservation_sub');
    }
};
