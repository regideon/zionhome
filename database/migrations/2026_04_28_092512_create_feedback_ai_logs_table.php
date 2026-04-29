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
        Schema::create('feedback_ai_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_id')->constrained('feedbacks')->cascadeOnDelete();

            $table->string('detected_category')->nullable();
            $table->string('detected_sentiment')->nullable();
            $table->string('detected_priority')->nullable();
            $table->boolean('is_high_risk')->default(false);

            $table->text('summary')->nullable();
            $table->text('suggested_action')->nullable();
            $table->json('raw_response')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_ai_logs');
    }
};
