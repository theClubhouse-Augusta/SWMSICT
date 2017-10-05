<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Options extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
      Schema::create('options', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('userID');
          $table->boolean('isStock')->nullable();
          $table->boolean('isBond')->nullable();
          $table->boolean('isMutualFund')->nullable();
          $table->boolean('isETF')->nullable();
          $table->boolean('isIndexFund')->nullable();
          $table->boolean('isRetirement')->nullable();
          $table->integer('minInvestment');
          $table->integer('riskLevel');
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
        Schema::dropIfExists('options');
    }
}
