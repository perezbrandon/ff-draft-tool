<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
});
*/

JsonApi::register('default', ['namespace' => 'Api'], function ($api, $router) {
    $api->resource('ppr_draft_rankings', [
        'only' => ['index']
    ]);
    $api->resource('teams', [
        'only' => ['index']
    ]);
    $api->resource('games', [
        'only' => ['index']
    ]);
    $api->resource('bye_weeks', [
        'only' => ['index']
    ]);
    $api->resource('players', [
        'only' => ['index']
    ]);
    $api->resource('draft_projections', [
        'only' => ['index']
    ]);
    $api->resource('user_leagues', [
        'only' => ['index']
    ]);
    $api->resource('roster_slots', [
        'only' => ['index']
    ]);
});
