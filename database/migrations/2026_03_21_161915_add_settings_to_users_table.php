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
        Schema::table('users', function (Blueprint $table) {
            $table->string('language')->default('en')->after('bio');
            $table->decimal('balance', 10, 2)->default(0)->after('language');
            $table->boolean('dark_mode')->default(true)->after('balance');
            $table->boolean('push_notifications')->default(true)->after('dark_mode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['language', 'balance', 'dark_mode', 'push_notifications']);
        });
    }
};
