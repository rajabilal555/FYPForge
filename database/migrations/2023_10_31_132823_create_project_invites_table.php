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
        Schema::create('project_invites', function (Blueprint $table) {
            $table->id();

            $table->text('message');

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('sent_by')
                ->constrained('students')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_invites');
    }
};
