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
        Schema::create('cake_infos', function (Blueprint $table) {
            $table->id();           //主キー->cake-info-sub,cake-photos
            $table->timestamps();
            $table->string('cakename');
            $table->string('mainphoto');
            $table->string('topic')->nullable(true);
            $table->text('explain');
            $table->string('cakecode');
            $table->boolean('boolean')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cake_infos');
    }
};
