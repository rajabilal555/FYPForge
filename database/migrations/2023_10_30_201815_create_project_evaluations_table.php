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
        Schema::create('project_evaluations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('evaluation_event_id')
                ->constrained('evaluation_events')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('evaluation_panel_id')
                ->constrained('evaluation_panels')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('term')
                ->comment('e.g. FYP1, FYP2');

            $table->integer('marks')
                ->nullable();

            $table->string('comments')
                ->comment('e.g. can be improved');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_evaluations');
    }
};
