<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_ownerships', function (Blueprint $table) {
            $table->renameColumn(
                'owner_user_id',
                'homeowner_profile_id'
            );
        });
    }

    public function down(): void
    {
        Schema::table('property_ownerships', function (Blueprint $table) {
            $table->renameColumn(
                'homeowner_profile_id',
                'owner_user_id'
            );
        });
    }
};
