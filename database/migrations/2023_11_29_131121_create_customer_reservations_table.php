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
            $table->string('num_tables');
            $table->string('num_guests');
            $table->date('reserve_date');
            $table->time('reserve_time');  
            $table->timestamp('request_date');
            $table->text('special_request');    
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('restaurants', function (Blueprint $table){
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('restaurant_id');
         
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_reservations');
    }
};
