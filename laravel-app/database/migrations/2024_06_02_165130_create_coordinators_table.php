<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coordinators', function (Blueprint $table) {
            $table->id('coordinator_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dean_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coordinators');
    }
};
