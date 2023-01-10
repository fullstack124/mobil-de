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
        Schema::create('equipment_comforts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('car_sells')->onDelete('cascade');
            $table->json('climate_control')->nullable();
            $table->string('parking_sensor')->nullable();
            $table->json('acoustic_parking_assistant')->nullable();
            $table->json('visual_parking_assistant')->nullable();
            $table->json('heated_seats')->nullable();
            $table->json('electric_adjustable_seats')->nullable();
            $table->json('other_features')->nullable();
            $table->json('other_comfort_equipment')->nullable();
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
        Schema::dropIfExists('equipment_comforts');
    }
};
