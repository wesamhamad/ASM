<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deans', function (Blueprint $table) {
            $table->id('dean_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coordinator_id');
            $table->string('department', 100)->nullable();
            $table->json('time_slots')->nullable(); // Add this line
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Add foreign key constraint for coordinator_id
        Schema::table('deans', function (Blueprint $table) {
            $table->foreign('coordinator_id')->references('coordinator_id')->on('coordinators')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deans');
    }
};
