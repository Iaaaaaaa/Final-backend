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
        Schema::create('customer_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->text('special_requests');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->timestamps();
        });

        Schema::table('customer_reservations', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('table_id')->references('id')->on('tables');
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_reservations', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['table_id']);
            $table->dropForeign(['restaurant_id']);
        });

        Schema::dropIfExists('customer_reservations');
    }
};
