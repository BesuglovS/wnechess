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

Route::get('Play', 'MainController@play');

Route::get('Players', 'PlayerController@index');
Route::get('Player/{id}', 'PlayerController@show');
Route::get('Games', 'GameController@index');
Route::get('Game/{id}', 'GameController@show');
Route::get('Games/Player/{id}', 'GameController@playerGames');
Route::get('Tournaments', 'TournamentController@showIndex');
Route::get('Tournament/{id}', 'TournamentController@show');
Route::get('Tournament/Graph/{id}', 'TournamentController@graph');

Route::group(['middleware' => ['auth']], function () {
//    ADMIN
    Route::resource('adminPlayers', 'AdminPlayerController');
    Route::resource('adminGames', 'AdminGameController');
    Route::resource('adminTournaments', 'AdminTournamentController');
    Route::resource('adminTournamentNodes', 'TournamentNodeController');
    Route::get('adminTournamentNodes/{id}/delete', 'TournamentNodeController@manualDestroy');

    Route::get('adminTournament/{id}/editSchema', 'TournamentNodeController@editSchema');
    Route::get('adminTournament/{id}/editSchema/addNode', 'TournamentNodeController@editSchemaAddNode');

    Route::get('adminTournament/{id}/createSchema', 'TournamentNodeController@createSchema');
    Route::get('adminTournament/createNewSchema', 'TournamentNodeController@createSchemaAction');

    Route::get('adminTournament/Graph/{id}', 'TournamentNodeController@graph');

    Route::get('/admin', 'AdminController@index');

    Route::get('/adminRecalculateRating', 'AdminController@RecalculateRating');

    Route::post('/adminRecalculateRatingAction', 'AdminController@AdminRecalculateRatingAction');
});


