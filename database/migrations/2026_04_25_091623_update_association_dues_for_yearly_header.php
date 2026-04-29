<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('association_dues', function (Blueprint $table) {
            if (! Schema::hasColumn('association_dues', 'association_due_lookup_id')) {
                $table->foreignId('association_due_lookup_id')
                    ->nullable()
                    ->after('homeowner_profile_id')
                    ->constrained()
                    ->nullOnDelete();
            }

            if (Schema::hasColumn('association_dues', 'billing_month')) {
                $table->dropColumn('billing_month');
            }

            if (Schema::hasColumn('association_dues', 'billing_frequency')) {
                $table->dropColumn('billing_frequency');
            }

            if (Schema::hasColumn('association_dues', 'billing_date')) {
                $table->dropColumn('billing_date');
            }

            if (Schema::hasColumn('association_dues', 'due_date')) {
                $table->dropColumn('due_date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('association_dues', function (Blueprint $table) {
            $table->unsignedTinyInteger('billing_month')->nullable();
            $table->string('billing_frequency')->default('monthly');
            $table->date('billing_date')->nullable();
            $table->date('due_date')->nullable();

            $table->dropConstrainedForeignId('association_due_lookup_id');
        });
    }
};
