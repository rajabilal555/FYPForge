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
        Schema::create('student_group_students', function (Blueprint $table) {
            $table->foreignId('student_id')
                ->unique() // One student can only be in one group
                ->constrained('students')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('student_group_id')
                ->constrained('student_groups')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->index(['student_id', 'student_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_group_students');
    }
};
