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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')
                ->nullable();

            $table->string('status');

            $table->string('approval_status');

            $table->string('term');

            $table->foreignId('evaluation_panel_id')
                ->nullable()
                ->constrained('evaluation_panels')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('advisor_id')
                ->nullable()
                ->constrained('advisors')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->dateTime('next_evaluation_date')
                ->nullable();

            $table->integer('is_final_evaluation')
                ->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
