<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_sells', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('popular_brand');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('model_id')->constrained('car_models')->onDelete('cascade');
            $table->foreignId('first_id')->constrained('first_registrations')->onDelete('cascade');
            $table->string('mileage');
            $table->string('doors');
            $table->string('fuel_type');
            $table->string('power');
            $table->string('is_registered');
            $table->string('type_of_sale');
            $table->string('plan_to_sell');
            $table->string('country');
            $table->string('postal_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_sells');
    }
};
