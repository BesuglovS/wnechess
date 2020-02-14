<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;

class AdminPlayerController extends Controller
{
    const NEW_PLAYER_RATING = 800;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::orderByDesc('rating')->orderbyDesc('averageOpponentRating')->orderBy('name')->get();

        return view('admin.player.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.player.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPlayer = new Player();
        $newPlayer->name = $request->name;
        $newPlayer->group = $request->group;

        $newPlayer->rating = self::NEW_PLAYER_RATING;
        $newPlayer->gamesPlayed = 0;
        $newPlayer->wins = 0;
        $newPlayer->draws = 0;
        $newPlayer->losses = 0;
        $newPlayer->averageOpponentRating = 0;

        $newPlayer->save();

        return redirect('/adminPlayers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        //
    }
}
