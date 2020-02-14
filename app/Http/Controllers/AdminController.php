<?php

namespace App\Http\Controllers;

use App\Game;
use App\Player;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function RecalculateRating() {
        return view('admin.recalculateRating');
    }

    public function AdminRecalculateRatingAction() {
        $players = Player::all();

        foreach($players as $player) {
            $player->rating = PlayerController::NEW_PLAYER_RATING;
            $player->gamesPlayed = 0;
            $player->wins = 0;
            $player->draws = 0;
            $player->losses = 0;
            $player->averageOpponentRating = 0;
            $player->save();
        }

        $games = Game::orderBy('games.date')->get();

        foreach($games as $newGame) {
            $p1 = 0; $p2 = 0;

            $pl1 = Player::find($newGame->player1Id);
            $pl2 = Player::find($newGame->player2Id);

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

            $newGame->player1RatingBefore = $pl1->rating;
            $newGame->player2RatingBefore = $pl2->rating;

            $e1 = 1 / (1 + pow(10, ($pl2->rating - $pl1->rating) / 400));
            $e2 = 1 / (1 + pow(10, ($pl1->rating - $pl2->rating) / 400));

            $pl1NewRating = round($pl1->rating + GameController::K_FACTOR * ($p1 - $e1));
            $pl2NewRating = round($pl2->rating + GameController::K_FACTOR * ($p2 - $e2));

            $newGame->player1RatingAfter = $pl1NewRating;
            $newGame->player2RatingAfter = $pl2NewRating;

            $newGame->save();

            $pl1->averageOpponentRating = ($pl1->averageOpponentRating * $pl1->gamesPlayed + $pl2->rating) / ($pl1->gamesPlayed + 1);
            $pl1->gamesPlayed++;
            $pl2->averageOpponentRating = ($pl2->averageOpponentRating * $pl2->gamesPlayed + $pl1->rating) / ($pl2->gamesPlayed + 1);
            $pl2->gamesPlayed++;

            $pl1->rating = $pl1NewRating;
            $pl1->save();
            $pl2->rating = $pl2NewRating;
            $pl2->save();
        }
    }
}
