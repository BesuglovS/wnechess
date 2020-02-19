<?php

namespace App\Http\Controllers;

use App\Game;
use App\Player;
use App\Tournament;
use App\TournamentNode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TournamentNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function editSchema(int $tournament_id) {
        $tournament = Tournament::find($tournament_id);

        $tournamentNodes = DB::table('tournament_nodes as node')
            ->leftJoin('games as game', 'node.game_id', '=', 'game.id')
            ->leftJoin('players as pl1', 'node.player1_id', '=', 'pl1.id')
            ->leftJoin('players as pl2', 'node.player2_id', '=', 'pl2.id')
            ->leftJoin('tournament_nodes as next_node', 'node.parent_id', '=', 'next_node.id')
            ->where('node.tournament_id', '=', $tournament_id)
            ->select('node.*', 'game.*', 'pl1.name as pl1Name', 'pl2.name as pl2Name', 'next_node.name as nextNodeName', 'node.id as id')
            ->get();

        return view('admin.tournament.editSchema', compact('tournament', 'tournamentNodes'));
    }

    public function editSchemaAddNode(int $tournament_id) {
        $tournament = Tournament::find($tournament_id);

        $tournamentNodes = DB::table('tournament_nodes as node')
            ->leftJoin('games as game', 'node.game_id', '=', 'game.id')
            ->leftJoin('players as pl1', 'node.player1_id', '=', 'pl1.id')
            ->leftJoin('players as pl2', 'node.player2_id', '=', 'pl2.id')
            ->where('node.tournament_id', '=', $tournament_id)
            ->select('node.*', 'game.*', 'pl1.name as pl1Name', 'pl2.name as pl2Name', 'node.id as id')
            ->get();

        $players = Player::all()->sortBy('name');

        $games = DB::table('games')
            ->join('players as pl1', 'games.player1Id', '=', 'pl1.id')
            ->join('players as pl2', 'games.player2Id', '=', 'pl2.id')
            ->leftJoin('tournaments', 'games.tournament_id', '=', 'tournaments.id')
            ->orderByDesc('games.date')
            ->where('games.tournament_id', '=', $tournament_id)
            ->select('games.*',
                'pl1.name as pl1Name', 'pl1.rating as pl1Rating', 'pl1.gamesPlayed as pl1GamesPlayed',
                'pl1.wins as pl1Wins', 'pl1.draws as pl1Draws', 'pl1.losses as pl1Losses',
                'pl1.averageOpponentRating as pl1AverageOpponentRating',
                'pl2.name as pl2Name', 'pl2.rating as pl2Rating', 'pl2.gamesPlayed as pl2GamesPlayed',
                'pl2.wins as pl2Wins', 'pl2.draws as pl2Draws', 'pl2.losses as pl2Losses',
                'pl2.averageOpponentRating as pl2AverageOpponentRating',
                'tournaments.name as tournamentName')
            ->get();

        return view('admin.tournament.editSchemaAddNode',
            compact('tournament', 'tournamentNodes', 'players', 'games'));
    }


    public function tournamentIndex(int $tournament_id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newTournamentNode = new TournamentNode();
        $newTournamentNode->name = $request->name;
        $newTournamentNode->parent_id = ($request->parent_id == -1) ? NULL : $request->parent_id;
        $newTournamentNode->game_id = ($request->game_id == -1) ? NULL : $request->game_id;
        $newTournamentNode->player1_id = ($request->player1_id == -1) ? NULL : $request->player1_id;
        $newTournamentNode->player2_id = ($request->player2_id == -1) ? NULL : $request->player2_id;
        $newTournamentNode->tournament_id = $request->tournament_id;

        $newTournamentNode->save();

        return redirect('/adminTournament/' . $request->tournament_id . '/editSchema');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TournamentNode  $tournamentNode
     * @return \Illuminate\Http\Response
     */
    public function show(TournamentNode $tournamentNode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TournamentNode  $tournamentNode
     * @return \Illuminate\Http\Response
     */
    public function edit(int $tournamentNodeId)
    {
        $tournamentNode = TournamentNode::find($tournamentNodeId);

        $tournament = Tournament::find($tournamentNode->tournament_id);

        $tournamentNodes = DB::table('tournament_nodes as node')
            ->leftJoin('games as game', 'node.game_id', '=', 'game.id')
            ->leftJoin('players as pl1', 'node.player1_id', '=', 'pl1.id')
            ->leftJoin('players as pl2', 'node.player2_id', '=', 'pl2.id')
            ->where('node.tournament_id', '=', $tournamentNode->tournament_id)
            ->select('node.*', 'game.*', 'pl1.name as pl1Name', 'pl2.name as pl2Name', 'node.id as node_id')
            ->get();

        $players = Player::all()->sortBy('name');

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

        return view('admin.tournament.editSchemaEditNode',
            compact('tournamentNode', 'tournament', 'tournamentNodes', 'players', 'games'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TournamentNode  $tournamentNode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $tournamentNodeId)
    {
        $tournamentNode = TournamentNode::find($tournamentNodeId);
        $tournamentNode->name = $request->name;
        $tournamentNode->game_id = ($request->game_id == -1) ? NULL : $request->game_id;
        $tournamentNode->parent_id = ($request->parent_id == -1) ? NULL : $request->parent_id;
        $tournamentNode->player1_id = ($request->player1_id == -1) ? NULL : $request->player1_id;
        $tournamentNode->player2_id = ($request->player2_id == -1) ? NULL : $request->player2_id;
        $tournamentNode->tournament_id = $request->tournament_id;
        $tournamentNode->save();

        return redirect('/adminTournament/' . $request->tournament_id . '/editSchema');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TournamentNode  $tournamentNode
     * @return \Illuminate\Http\Response
     */
    public function destroy(TournamentNode $tournamentNode)
    {
        //
    }

    public function manualDestroy(int $node_id)
    {
        TournamentNode::destroy($node_id);

        return redirect()->back();
    }
}
