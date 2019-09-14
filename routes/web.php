<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->get('/', function () use ($router) {
    $users = \App\User::all();

    dd(\App\History::all());

    dd($users);

    return $router->app->version();
});

$router->get('/histories', 'HistoriesController@index');
$router->get('/histories/{id}', 'HistoriesController@show');
$router->post('/histories', 'HistoriesController@store');
$router->put('/histories/{id}', 'HistoriesController@update');
$router->delete('/histories/{id}', 'HistoriesController@delete');
