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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('homeowner_profile_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('subdivision_phase_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('street_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('feedback_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('feedback_category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('feedback_status_id')->constrained()->restrictOnDelete();
            $table->foreignId('feedback_priority_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();

            $table->string('reference_no')->nullable()->unique();
            $table->string('title');
            $table->text('message');

            $table->string('location_label')->nullable();
            $table->string('block_no')->nullable();
            $table->string('lot_no')->nullable();

            $table->boolean('is_anonymous')->default(false);
            $table->boolean('is_emergency')->default(false);
            $table->boolean('is_public')->default(false);

            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();

            $table->text('admin_notes')->nullable();

            $table->timestamps();

            $table->index([
                'property_id',
                'subdivision_phase_id',
                'street_id',
                'feedback_type_id',
                'feedback_status_id',
                'feedback_priority_id',
            ], 'feedbacks_dashboard_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
