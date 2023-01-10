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
        Schema::create('vehicle_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('car_sells')->onDelete('cascade');
            $table->string('category');
            $table->string('sliding_door');
            $table->string('number_of_seats');
            $table->string('cubic_capacity');
            $table->string('gear_box');
            $table->string('paddle_shifters');
            $table->string('four_wheel_drive');
            $table->string('emission_class');
            $table->string('emission_sticker');
            $table->string('particulate_filter');
            $table->string('start_stop_system');
            $table->string('comb');
            $table->string('urban');
            $table->string('extra_urban');
            $table->string('emission_comb');
            $table->string('sub_category');
            $table->string('vehicle_owner');
            $table->string('damage_vehicle');
            $table->string('accident_damage_vehicle');
            $table->string('road_worthy');
            $table->string('non_smoking_vehicle');
            $table->string('valid_until');
            $table->string('full_service_history');
            $table->string('warranty_factory');
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
        Schema::dropIfExists('vehicle_data');
    }
};
