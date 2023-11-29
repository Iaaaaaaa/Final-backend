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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name');
            $table->text('description');
            $table->string('cuisine');  
            $table->string('address');
            $table->string('city');
            $table->string('zip_code');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('restaurants', function (Blueprint $table){
            $table->unsignedBigInteger('owner_id');
         
            $table->foreign('owner_id')->references('id')->on('restaurant_owners');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
