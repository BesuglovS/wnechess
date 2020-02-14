<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::orderByDesc('rating')->orderbyDesc('averageOpponentRating')->orderBy('name')->get();

        return view('player.index', compact('players'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(int $playerId)
    {
        $player = Player::find($playerId);

        $gc = new GameController();

        $playerGames = $gc->playerGames($playerId);

        if ($player) {
            return view('player.show', compact('player', 'playerGames'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //
    }
}
