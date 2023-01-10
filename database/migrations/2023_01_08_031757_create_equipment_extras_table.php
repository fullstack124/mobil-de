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
        Schema::create('equipment_extras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('car_sells')->onDelete('cascade');
            $table->json('tires_and_rims')->nullable();
            $table->json('break_down_service')->nullable();
            $table->json('special_features')->nullable();
            $table->json('trailer_coupling')->nullable();
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
        Schema::dropIfExists('equipment_extras');
    }
};
