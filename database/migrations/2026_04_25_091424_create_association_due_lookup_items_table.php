<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('association_due_lookup_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('association_due_lookup_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('billing_month');
            $table->string('month_name');
            $table->date('due_date')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['association_due_lookup_id', 'billing_month'], 'assoc_due_lookup_month_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('association_due_lookup_items');
    }
};
