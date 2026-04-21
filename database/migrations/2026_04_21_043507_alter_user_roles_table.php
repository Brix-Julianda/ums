<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_roles', function (Blueprint $table) {

            // 1. Add role_id column
            $table->foreignId('role_id')
                ->nullable()
                ->after('user_id')
                ->constrained('roles')
                ->onDelete('cascade');

            // 2. Keep role_name temporarily (DO NOT force change)
            // We will drop it AFTER data migration step
        });
    }

    public function down(): void
    {
        Schema::table('user_roles', function (Blueprint $table) {

            // rollback role_id
            $table->dropConstrainedForeignId('role_id');
        });
    }
};
