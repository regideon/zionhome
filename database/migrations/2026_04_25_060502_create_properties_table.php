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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('area_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('subdivision_phase_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('street_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('property_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('occupancy_status_id')->constrained()->restrictOnDelete();
            $table->foreignId('property_status_id')->constrained()->restrictOnDelete();

            $table->string('property_code')->unique();
            // Example: P1-BLK3-LOT12

            $table->string('block_no')->nullable();
            $table->string('lot_no')->nullable();
            $table->decimal('lot_area_sqm', 10, 2)->nullable();

            $table->string('house_no')->nullable();
            $table->text('address')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->index([
                'city_id',
                'area_id',
                'subdivision_phase_id',
                'street_id',
                'property_type_id',
                'occupancy_status_id',
                'property_status_id',
            ], 'properties_detailed_search_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
