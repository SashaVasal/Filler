<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Game extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Games', function (Blueprint $table) {
            $table->id();
            $table->integer('id_field');
            $table->integer('id_player_1');
            $table->integer('id_player_2');
            $table->integer('currentPlayerId');
            $table->integer('winnerPlayerId');
            $table->timestamps();
        });

        Schema::create('Fields', function (Blueprint $table) {
            $table->id();
            $table->integer('width');
            $table->integer('height');
            $table->timestamps();
        });

        Schema::create('Cells', function (Blueprint $table) {
            $table->id();
            $table->integer('id_field');
            $table->string('color');
            $table->integer('x');
            $table->integer('y');
            $table->integer('playerId');
            $table->timestamps();
        });
        Schema::create('Players', function (Blueprint $table) {
            $table->id();
            $table->string('color');
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
        //
    }
}
