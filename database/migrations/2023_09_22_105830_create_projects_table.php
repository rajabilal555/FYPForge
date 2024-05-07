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

            $table->foreignId('advisor_id')
                ->nullable()
                ->constrained('advisors')
                ->nullOnDelete()->cascadeOnUpdate();

            $table->foreignId('evaluation_panel_id')
                ->nullable()
                ->constrained('evaluation_panels')
                ->nullOnDelete()->cascadeOnUpdate();

            $table->tinyInteger('is_archived')
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
