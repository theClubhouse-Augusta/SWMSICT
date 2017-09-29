<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Investments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('investments', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('userID');
          $table->string('name');
          $table->string('age');
          $table->string('goal');
          $table->integer('amount');
          $table->boolean('reoccurring');
          $table->string('contribution');
          $table->integer('horizon_num');
          $table->string('horizon_type');
          $table->boolean('stocks')->nullable();
          $table->boolean('options')->nullable();
          $table->boolean('exTradeFunds')->nullable();
          $table->boolean('secFutures')->nullable();
          $table->boolean('bonds')->nullable();
          $table->boolean('mutualFunds')->nullable();
          $table->boolean('collegeSavings')->nullable();
          $table->boolean('commodityFutures')->nullable();
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
        Schema::dropIfExists('investments');
    }
}
