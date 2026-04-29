<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('association_due_items', function (Blueprint $table) {
            if (! Schema::hasColumn('association_due_items', 'association_due_lookup_item_id')) {
                $table->foreignId('association_due_lookup_item_id')
                    ->nullable()
                    ->after('association_due_id')
                    ->constrained()
                    ->nullOnDelete();
            }

            if (! Schema::hasColumn('association_due_items', 'association_due_item_status_id')) {
                $table->foreignId('association_due_item_status_id')
                    ->nullable()
                    ->after('association_due_lookup_item_id')
                    ->constrained()
                    ->nullOnDelete();
            }

            if (! Schema::hasColumn('association_due_items', 'billing_month')) {
                $table->unsignedTinyInteger('billing_month')->after('association_due_item_status_id');
            }

            if (! Schema::hasColumn('association_due_items', 'month_name')) {
                $table->string('month_name')->after('billing_month');
            }

            if (! Schema::hasColumn('association_due_items', 'due_date')) {
                $table->date('due_date')->nullable()->after('month_name');
            }

            if (! Schema::hasColumn('association_due_items', 'paid_amount')) {
                $table->decimal('paid_amount', 15, 2)->default(0)->after('amount');
            }

            if (! Schema::hasColumn('association_due_items', 'balance_amount')) {
                $table->decimal('balance_amount', 15, 2)->default(0)->after('paid_amount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('association_due_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('association_due_lookup_item_id');
            $table->dropConstrainedForeignId('association_due_item_status_id');

            $table->dropColumn([
                'billing_month',
                'month_name',
                'due_date',
                'paid_amount',
                'balance_amount',
            ]);
        });
    }
};
