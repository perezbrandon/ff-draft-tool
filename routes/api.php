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
        'only' => ['index', 'read']
    ]);
});
