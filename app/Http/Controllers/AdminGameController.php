<?php

namespace App\Http\Controllers;

use App\Game;
use App\Player;
use App\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminGameController extends Controller
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

        return view('admin.game.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $players = Player::all()->sortBy('name');

        $tournaments = Tournament::all();

        return view('admin.game.create', compact('players', 'tournaments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pl1 = Player::find($request->player1Id);
        $pl2 = Player::find($request->player2Id);

        $newGame = new Game();
        $newGame->player1Id = $request->player1Id;
        $newGame->player2Id = $request->player2Id;
        $newGame->tournament_id = $request->tournament_id;
        $newGame->result = $request->result;

        $p1 = 0; $p2 = 0;

        switch ($newGame->result)
        {
            case 1:
                $p1 = 1;
                $p2 = 0;

                $pl1->wins++;
                $pl2->losses++;
                break;
            case 0:
                $p1 = 0.5;
                $p2 = 0.5;

                $pl1->draws++;
                $pl2->draws++;
                break;
            case -1:
                $p1 = 0;
                $p2 = 1;

                $pl1->losses++;
                $pl2->wins++;
                break;
            default:
                break;
        }

        $newGame->date = Carbon::now();

        $newGame->player1RatingBefore = $pl1->rating;
        $newGame->player2RatingBefore = $pl2->rating;

        $e1 = 1 / (1 + pow(10, ($pl2->rating - $pl1->rating) / 400));
        $e2 = 1 / (1 + pow(10, ($pl1->rating - $pl2->rating) / 400));

        $pl1NewRating = round($pl1->rating + self::K_FACTOR * ($p1 - $e1));
        $pl2NewRating = round($pl2->rating + self::K_FACTOR * ($p2 - $e2));

        $newGame->player1RatingAfter = $pl1NewRating;
        $newGame->player2RatingAfter = $pl2NewRating;

        $pl1->averageOpponentRating = ($pl1->averageOpponentRating * $pl1->gamesPlayed + $pl2->rating) / ($pl1->gamesPlayed + 1);
        $pl1->gamesPlayed++;
        $pl2->averageOpponentRating = ($pl2->averageOpponentRating * $pl2->gamesPlayed + $pl1->rating) / ($pl2->gamesPlayed + 1);
        $pl2->gamesPlayed++;

        $pl1->rating = $pl1NewRating;
        $pl1->save();
        $pl2->rating = $pl2NewRating;
        $pl2->save();

        $newGame->save();
        return redirect('/adminGames');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(int $game_id)
    {
        $game = Game::find($game_id);

        $players = Player::all()->sortBy('name');

        $tournaments = Tournament::all();

        return view('admin.game.edit', compact('game', 'players', 'tournaments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $game_id)
    {
        $game = Game::find($game_id);
        $game->player1Id = $request->player1Id;
        $game->player2Id = $request->player2Id;
        $game->tournament_id = $request->tournament_id;
        $game->result = $request->result;
        $game->pgn = $request->pgn;
        $game->save();

        return redirect('/adminTournaments/' . $game->tournament_id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
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
