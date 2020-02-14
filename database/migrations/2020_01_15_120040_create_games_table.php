<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date');
            $table->bigInteger('player1Id');
            $table->bigInteger('player2Id');
            $table->integer('player1RatingBefore');
            $table->integer('player1RatingAfter');
            $table->integer('player2RatingBefore');
            $table->integer('player2RatingAfter');
            $table->integer('result'); // 1 - white wins; 0 - draw; -1 - black wins
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
