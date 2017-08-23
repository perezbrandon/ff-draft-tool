<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('player_id');
            $table->boolean('active');
            $table->integer('jersey')->nullable();
            $table->string('fname');
            $table->string('lname');
            $table->string('display_name');
            $table->string('team');
            $table->string('position');
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->date('dob')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
