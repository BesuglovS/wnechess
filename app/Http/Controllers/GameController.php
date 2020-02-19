<?php

namespace App\Http\Controllers;

use App\Game;
use App\Player;
use App\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    const K_FACTOR = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = DB::table('games')
            ->join('players as pl1', 'games.player1Id', '=', 'pl1.id')
            ->join('players as pl2', 'games.player2Id', '=', 'pl2.id')
            ->leftJoin('tournaments', 'games.tournament_id', '=', 'tournaments.id')
            ->orderByDesc('games.date')
            ->select('games.*',
                'pl1.name as pl1Name', 'pl1.rating as pl1Rating', 'pl1.gamesPlayed as pl1GamesPlayed',
                'pl1.wins as pl1Wins', 'pl1.draws as pl1Draws', 'pl1.losses as pl1Losses',
                'pl1.averageOpponentRating as pl1AverageOpponentRating',
                'pl2.name as pl2Name', 'pl2.rating as pl2Rating', 'pl2.gamesPlayed as pl2GamesPlayed',
                'pl2.wins as pl2Wins', 'pl2.draws as pl2Draws', 'pl2.losses as pl2Losses',
                'pl2.averageOpponentRating as pl2AverageOpponentRating',
                'tournaments.name as tournamentName')
            ->get();

        return view('game.index', compact('games'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(int $gameId)
    {
        $game = DB::table('games')
            ->join('players as pl1', 'games.player1Id', '=', 'pl1.id')
            ->join('players as pl2', 'games.player2Id', '=', 'pl2.id')
            ->leftJoin('tournaments', 'games.tournament_id', '=', 'tournaments.id')
            ->orderByDesc('games.date')
            ->select('games.*',
                'pl1.name as pl1Name', 'pl1.rating as pl1Rating', 'pl1.gamesPlayed as pl1GamesPlayed',
                'pl1.wins as pl1Wins', 'pl1.draws as pl1Draws', 'pl1.losses as pl1Losses',
                'pl1.averageOpponentRating as pl1AverageOpponentRating',
                'pl2.name as pl2Name', 'pl2.rating as pl2Rating', 'pl2.gamesPlayed as pl2GamesPlayed',
                'pl2.wins as pl2Wins', 'pl2.draws as pl2Draws', 'pl2.losses as pl2Losses',
                'pl2.averageOpponentRating as pl2AverageOpponentRating',
                'tournaments.name as tournamentName')
            ->where('games.id', '=', $gameId)
            ->first();

        return view('game.show', compact('game'));
    }

    public function playerGames(int $playerId) {
        return DB::table('games')
            ->join('players as pl1', 'games.player1Id', '=', 'pl1.id')
            ->join('players as pl2', 'games.player2Id', '=', 'pl2.id')
            ->leftJoin('tournaments', 'games.tournament_id', '=', 'tournaments.id')
            ->orderByDesc('games.date')
            ->where('pl1.id', '=', $playerId)
            ->orWhere('pl2.id', '=', $playerId)
            ->select('games.*',
                'pl1.id as pl1Id', 'pl2.id as pl2Id',
                'pl1.name as pl1Name', 'pl1.rating as pl1Rating', 'pl1.gamesPlayed as pl1GamesPlayed',
                'pl1.wins as pl1Wins', 'pl1.draws as pl1Draws', 'pl1.losses as pl1Losses',
                'pl1.averageOpponentRating as pl1AverageOpponentRating',
                'pl2.name as pl2Name', 'pl2.rating as pl2Rating', 'pl2.gamesPlayed as pl2GamesPlayed',
                'pl2.wins as pl2Wins', 'pl2.draws as pl2Draws', 'pl2.losses as pl2Losses',
                'pl2.averageOpponentRating as pl2AverageOpponentRating',
                'tournaments.name as tournamentName')
            ->get();
    }
}
