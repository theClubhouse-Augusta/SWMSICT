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
          $table->string('name');
          $table->string('age');
          $table->string('goal');
          $table->integer('amount');
          $table->boolean('reoccurring');
          $table->string('contribution');
          $table->integer('horizon_num');
          $table->string('horizon_type');
          $table->integer('search');
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
