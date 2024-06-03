<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('dean_id');
            $table->unsignedBigInteger('coordinator_id')->nullable();
            $table->dateTime('appointment_time');
            $table->enum('status', ['pending', 'confirmed', 'canceled']);
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('dean_id')->references('dean_id')->on('deans')->onDelete('cascade');
            $table->foreign('coordinator_id')->references('coordinator_id')->on('coordinators')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
