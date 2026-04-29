<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('association_due_lookups', function (Blueprint $table) {
            $table->id();
            $table->year('billing_year')->unique();
            $table->string('name');
            $table->decimal('default_monthly_amount', 15, 2)->default(0);
            $table->unsignedTinyInteger('default_due_day')->default(15);
            $table->boolean('is_generated')->default(false);
            $table->boolean('is_published')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('association_due_lookups');
    }
};
