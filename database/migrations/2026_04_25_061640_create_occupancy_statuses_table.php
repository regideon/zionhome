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
        Schema::create('occupancy_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Vacant, Owner Occupied, Tenant Occupied
            $table->string('code')->nullable(); // vacant, owner, tenant
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupancy_statuses');
    }
};
