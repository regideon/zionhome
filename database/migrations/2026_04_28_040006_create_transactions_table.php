<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->unique();
            $table->foreignId('transaction_type_id')->constrained('transaction_types');
            $table->foreignId('transaction_status_id')->constrained('transaction_statuses');
            $table->nullableMorphs('transactable');    // AssociationDue, Expense, etc.
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // payer/homeowner
            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['cash', 'gcash', 'bank_transfer', 'check', 'other'])->nullable();
            $table->string('receipt_image')->nullable();
            $table->text('description')->nullable();
            $table->date('transaction_date');
            $table->text('notes')->nullable();
            $table->foreignId('recorded_by')->constrained('users');
            $table->timestamp('posted_at')->nullable();
            $table->foreignId('posted_by')->nullable()->constrained('users');
            $table->timestamp('voided_at')->nullable();
            $table->string('void_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
