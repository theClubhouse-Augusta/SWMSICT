<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Filters extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
      Schema::create('filters', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('userID');
          $table->boolean('specialOffers')->nullable();
          $table->boolean('financialSupport')->nullable();
          $table->boolean('locationAvailable')->nullable();
          $table->boolean('repAvailable')->nullable();
          $table->boolean('feesLowToHigh')->nullable();
          $table->boolean('feesHighToLow')->nullable();
          $table->boolean('fundPerfBestToWorst')->nullable();
          $table->boolean('fundPerfWorstToBest')->nullable();
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
        Schema::dropIfExists('filters');
    }
}
