<?php

namespace App\Http\Controllers;

use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function play()
    {
        return view('main.play');
    }

    public function brb(int $tournamentId)
    {
        $tournament = Tournament::find($tournamentId);

        $tournamentNodes = DB::table('tournament_nodes as node')
            ->leftJoin('games as game', 'node.game_id', '=', 'game.id')
            ->leftJoin('players as pl1', 'node.player1_id', '=', 'pl1.id')
            ->leftJoin('players as pl2', 'node.player2_id', '=', 'pl2.id')
            ->where('node.tournament_id', '=', $tournamentId)
            ->select('node.*', 'game.*', 'pl1.name as pl1Name', 'pl2.name as pl2Name', 'node.id as node_id')
            ->get();

        return view('main.brb', compact('tournament', 'tournamentNodes'));
    }
}
