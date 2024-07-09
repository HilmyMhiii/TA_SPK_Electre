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
        Schema::create('comparison_sub_criterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criteria_id');
            $table->unsignedBigInteger('sub_criteria_id')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->string('value');

            // Set foreign key constraint
            $table->foreign('criteria_id')->references('id')->on('criterias');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comparison_sub_criterias');
    }
};
