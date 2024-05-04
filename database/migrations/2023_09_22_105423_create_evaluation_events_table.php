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
        Schema::create('evaluation_events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('start_datetime');
            $table->integer('per_project_duration');
            $table->integer('total_marks');
            $table->tinyInteger('is_final_evaluation');
            $table->tinyInteger('shuffle_evaluation_panels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_events');
    }
};
