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
        Schema::create('main_reservation', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('users_id');
            $table->date('birthday');
            $table->time('time'); //誤字訂正する
            $table
                ->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_reservation');
    }
};
