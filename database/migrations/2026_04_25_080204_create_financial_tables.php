<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('normal_balance'); // debit, credit
            $table->timestamps();
        });

        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_type_id')->constrained()->cascadeOnDelete();
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chart_of_account_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('type')->default('bank'); // bank, cash, gcash
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('association_due_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Annual Dues, Monthly Dues, Penalty
            $table->foreignId('income_account_id')->nullable()->constrained('chart_of_accounts')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('association_due_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Unpaid, Partial, Paid, Overdue
            $table->string('color')->nullable();
            $table->timestamps();
        });

        Schema::create('association_dues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('homeowner_profile_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('association_due_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('association_due_status_id')->constrained()->restrictOnDelete();

            $table->string('reference_no')->nullable()->unique();

            $table->year('billing_year');
            $table->unsignedTinyInteger('billing_month')->nullable();
            $table->string('billing_frequency')->default('monthly');
            // monthly, yearly, one_time

            $table->date('billing_date')->nullable();
            $table->date('due_date')->nullable();

            $table->decimal('subtotal_amount', 15, 2)->nullable();
            $table->decimal('discount_amount', 15, 2)->nullable();
            $table->decimal('penalty_amount', 15, 2)->nullable();
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->decimal('paid_amount', 15, 2)->nullable();
            $table->decimal('balance_amount', 15, 2)->nullable();

            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('association_due_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('association_due_id')->constrained()->cascadeOnDelete();
            $table->string('description');
            $table->decimal('amount', 15, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Cash, GCash, Bank Transfer
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('payment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Pending, Verified, Rejected
            $table->string('color')->nullable();
            $table->timestamps();
        });

        /*
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('association_due_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('homeowner_profile_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('payment_method_id')->constrained()->restrictOnDelete();
            $table->foreignId('payment_status_id')->constrained()->restrictOnDelete();
            $table->foreignId('bank_account_id')->nullable()->constrained()->nullOnDelete();

            $table->string('reference_no')->nullable()->unique();
            $table->date('paid_date')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('external_reference_no')->nullable();
            $table->string('receipt_path')->nullable();

            $table->text('notes')->nullable();

            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
        */

        Schema::create('expense_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Unpaid, Paid, Cancelled
            $table->string('color')->nullable();
            $table->timestamps();
        });

        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('expense_account_id')->nullable()->constrained('chart_of_accounts')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_category_id')->constrained()->restrictOnDelete();
            $table->foreignId('expense_status_id')->constrained()->restrictOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('bank_account_id')->nullable()->constrained()->nullOnDelete();

            $table->string('reference_no')->nullable()->unique();
            $table->date('expense_date')->nullable();
            $table->string('title');
            $table->decimal('subtotal_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->decimal('balance_amount', 15, 2)->default(0);

            $table->text('notes')->nullable();
            $table->string('receipt_path')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('expense_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_id')->constrained()->cascadeOnDelete();
            $table->string('description');
            $table->decimal('quantity', 15, 2)->default(1);
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->timestamps();
        });

        /*
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_id')->nullable()->constrained()->nullOnDelete();

            $table->nullableMorphs('transactionable');

            $table->string('direction'); // money_in, money_out
            $table->string('reference_no')->nullable()->unique();
            $table->date('transaction_date')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->text('description')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();

            $table->nullableMorphs('journalable');

            $table->string('reference_no')->nullable()->unique();
            $table->date('entry_date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_posted')->default(false);

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('journal_entry_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_entry_id')->constrained()->cascadeOnDelete();
            $table->foreignId('chart_of_account_id')->constrained()->restrictOnDelete();

            $table->decimal('debit_amount', 15, 2)->default(0);
            $table->decimal('credit_amount', 15, 2)->default(0);
            $table->text('description')->nullable();

            $table->timestamps();
        });
        */
    }

    public function down(): void
    {
        // Schema::dropIfExists('journal_entry_lines');
        // Schema::dropIfExists('journal_entries');
        // Schema::dropIfExists('transactions');
        Schema::dropIfExists('expense_items');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('expense_categories');
        Schema::dropIfExists('expense_statuses');
        // Schema::dropIfExists('collections');
        Schema::dropIfExists('payment_statuses');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('association_due_items');
        Schema::dropIfExists('association_dues');
        Schema::dropIfExists('association_due_statuses');
        Schema::dropIfExists('association_due_types');
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('chart_of_accounts');
        Schema::dropIfExists('account_types');
    }
};
