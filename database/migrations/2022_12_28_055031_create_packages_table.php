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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name')->nullable();
            $table->string('package_duration')->nullable();
            $table->string('package_gallery')->nullable();
            $table->string('package_visibility')->nullable();
            $table->string('package_statistics')->nullable();
            $table->string('package_highlighted')->nullable();
            $table->string('package_ad_in_first_page')->nullable();
            $table->string('package_price_per_ad')->nullable();
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
        Schema::dropIfExists('packages');
    }
};
