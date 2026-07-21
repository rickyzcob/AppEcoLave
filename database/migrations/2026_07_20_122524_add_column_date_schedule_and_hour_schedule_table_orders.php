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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_id')->nullable()->after('user_id');
            $table->foreign('vehicle_id')->references('id')->on('users_vehicles');
            $table->date('date_schedule')->nullable()->after('rate');
            $table->time('hour_schedule')->nullable()->after('date_schedule');
            $table->text('observations')->nullable()->after('hour_schedule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('date_schedule');
            $table->dropColumn('hour_schedule');
            $table->dropColumn('observations');
        });
    }
};
