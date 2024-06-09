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
        Schema::create('project_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->json('evaluation_event_ids');

            $table->integer('total_marks');

            $table->integer('total_marks_obtained');

            $table->json('marks_breakdown_data');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_results');
    }
};
