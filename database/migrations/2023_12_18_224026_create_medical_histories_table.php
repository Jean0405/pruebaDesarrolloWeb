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
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->string('professional_id');
            $table->string('patient_id');
            $table->dateTime('date_time');
            $table->integer('history_consecutive');
            $table->string('current_patient_state');
            $table->text('medical_history');
            $table->text('final_evolution');
            $table->text('professional_opinion');
            $table->text('recommendations');
            $table->timestamps();

            $table->foreign('professional_id')->references('identification_number')->on('users');
            $table->foreign('patient_id')->references('identification_number')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_history_models');
    }
};
