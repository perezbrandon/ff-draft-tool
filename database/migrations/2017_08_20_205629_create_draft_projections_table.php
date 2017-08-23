<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftProjectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('draft_projections', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('player_id');
            $table->integer('completions');
            $table->integer('attempts');
            $table->integer('passing_yards');
            $table->integer('passing_td');
            $table->integer('passing_int');
            $table->integer('rush_yards');
            $table->integer('rush_td');
            $table->integer('fantasy_points');
            $table->string('display_name');
            $table->string('team');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('draft_projections');
    }
}
