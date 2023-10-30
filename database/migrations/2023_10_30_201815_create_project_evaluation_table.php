<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_evaluation', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('panel_id')
                ->constrained('panels')
                ->cascadeOnDelete()->cascadeOnUpdate();

            // Status can be Satisfactory, Rejected, or Needs Improvement
            $table->string('status')
                ->default('Satisfactory');

            $table->string('remarks')
                ->comment('e.g. can be improved');

            $table->integer('score')
                ->default(0);

            $table->dateTime('evaluation_date')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_evaluation');
    }
};
