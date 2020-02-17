<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('Players', 'PlayerController@index');
Route::get('Player/{id}', 'PlayerController@show');
Route::get('Games', 'GameController@index');
Route::get('Game/{id}', 'GameController@show');
Route::get('Games/Player/{id}', 'GameController@playerGames');
Route::get('Tournaments', 'TournamentController@showIndex');
Route::get('Tournament/{id}', 'TournamentController@show');

Route::group(['middleware' => ['auth']], function () {
//    ADMIN
    Route::resource('adminPlayers', 'AdminPlayerController');
    Route::resource('adminGames', 'AdminGameController');
    Route::resource('adminTournaments', 'AdminTournamentController');

    Route::get('/admin', 'AdminController@index');

    Route::get('/adminRecalculateRating', 'AdminController@RecalculateRating');

    Route::post('/adminRecalculateRatingAction', 'AdminController@AdminRecalculateRatingAction');
});
