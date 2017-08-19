<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePprDraftRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppr_draft_rankings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('position');
            $table->string('display_name');
            $table->string('fname');
            $table->string('lname');
            $table->string('team');
            $table->integer('bye_week');
            $table->float('nerd_rank');
            $table->integer('position_rank');
            $table->integer('overall_rank');
            $table->integer('player_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppr_draft_rankings');
    }
}
