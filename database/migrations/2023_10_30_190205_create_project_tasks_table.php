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
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')
                ->nullable();
            $table->string('status');

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('remarks')
                ->nullable();

            $table->dateTime('due_date')
                ->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tasks');
    }
};
