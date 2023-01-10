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
        Schema::create('equipment_infotainments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('car_sells')->onDelete('cascade');
            $table->json('multimedia')->nullable();
            $table->json('handing_and_control')->nullable();
            $table->json('connectivity_and_interfaces')->nullable();
            $table->json('cockpit_display')->nullable();
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
        Schema::dropIfExists('equipment_infotainments');
    }
};
