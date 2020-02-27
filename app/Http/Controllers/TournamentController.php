<?php

namespace App\Http\Controllers;

use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TournamentController extends Controller
{
    public function showIndex()
    {
        $tournaments = DB::table('tournaments')
            ->leftjoin('games', 'tournaments.id', '=', 'games.tournament_id')
            ->select('tournaments.id', 'tournaments.name', 'tournaments.type', DB::raw('Count(' . env('DB_TABLE_PREFIX', '') . 'games.id) as game_count'))
            ->groupBy('tournaments.id')
            ->get();

        return view('tournament.index', compact('tournaments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(int $tournamentId)
    {
        $tournament = Tournament::find($tournamentId);

        $tournamentNodes = DB::table('tournament_nodes as node')
            ->leftJoin('games as game', 'node.game_id', '=', 'game.id')
            ->leftJoin('players as pl1', 'node.player1_id', '=', 'pl1.id')
            ->leftJoin('players as pl2', 'node.player2_id', '=', 'pl2.id')
            ->leftJoin('tournament_nodes as next_node', 'node.parent_id', '=', 'next_node.id')
            ->where('node.tournament_id', '=', $tournamentId)
            ->select('node.*', 'game.*', 'pl1.name as pl1Name', 'pl2.name as pl2Name', 'next_node.name as nextNodeName', 'node.id as id')
            ->get();

        $tournamentGames = DB::table('games')
            ->join('players as pl1', 'games.player1Id', '=', 'pl1.id')
            ->join('players as pl2', 'games.player2Id', '=', 'pl2.id')
            ->leftJoin('tournaments', 'games.tournament_id', '=', 'tournaments.id')
            ->where('games.tournament_id', '=', $tournamentId)
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

        return view('tournament.show', compact('tournament', 'tournamentNodes', 'tournamentGames'));
    }

    public function graph(int $tournamentId) {
        $tournament = Tournament::find($tournamentId);

        $tournamentNodes = DB::table('tournament_nodes as node')
            ->leftJoin('games as game', 'node.game_id', '=', 'game.id')
            ->leftJoin('players as pl1', 'node.player1_id', '=', 'pl1.id')
            ->leftJoin('players as pl2', 'node.player2_id', '=', 'pl2.id')
            ->where('node.tournament_id', '=', $tournamentId)
            ->select('node.*', 'game.*', 'pl1.name as pl1Name', 'pl2.name as pl2Name', 'node.id as node_id')
            ->get();

        return view('tournament.graph', compact('tournament', 'tournamentNodes'));
    }
}
