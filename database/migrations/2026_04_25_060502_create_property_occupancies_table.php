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
        Schema::create('property_occupancies', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('occupant_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('occupancy_type_id')
                ->nullable()
                ->constrained('occupancy_types')
                ->nullOnDelete();

            $table->string('occupant_name')->nullable();
            // useful if tenant is not yet registered as app user

            $table->string('contact_number')->nullable();

            $table->date('move_in_date')->nullable();
            $table->date('move_out_date')->nullable();

            $table->boolean('is_current')->default(true);

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->index(['property_id', 'occupant_user_id', 'is_current', 'occupancy_type_id'], 'property_occupancies_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_occupancies');
    }
};
