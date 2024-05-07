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
        Schema::create('evaluation_event_project', function (Blueprint $table) {
            $table->foreignId('evaluation_event_id')
                ->constrained('evaluation_events')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->dateTime('evaluation_date');

            $table->primary(['evaluation_event_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_event_project');
    }
};
