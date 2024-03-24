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

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('term')
                ->comment('e.g. FYP1, FYP2');

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('evaluation_panel_id')
                ->constrained('evaluation_panels')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('marks')
                ->nullable();

            $table->integer('is_final')
                ->default(0) // 0 = false, 1 = true
                ->comment('Final evaluation or not');

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
