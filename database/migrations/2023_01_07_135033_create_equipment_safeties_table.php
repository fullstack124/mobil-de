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
        Schema::create('equipment_safeties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('car_sells')->onDelete('cascade');
            $table->json('assistance_system')->nullable();
            $table->string('cruise_control')->nullable();
            $table->string('speed_limit_control')->nullable();
            $table->string('distance_warning_system')->nullable();
            $table->string('air_bags')->nullable();
            $table->string('isofix')->nullable();
            $table->string('passenger_seat')->nullable();
            $table->string('head_light_type')->nullable();
            $table->string('washer_system')->nullable();
            $table->json('full_beam')->nullable();
            $table->string('day_time_runing_light')->nullable();
            $table->string('adaptive_lighting')->nullable();
            $table->string('fog_lamp')->nullable();
            $table->json('theft_protection')->nullable();
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
        Schema::dropIfExists('equipment_safeties');
    }
};
