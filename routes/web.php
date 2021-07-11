<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function() use($router){

    $router->post('singup', 'UserController@register');
    $router->post('login', 'UserController@login');
    $router->post('logout', 'UserController@logout');
    $router->post('refresh', 'UserController@refresh');

    $router->get('bill/list', 'BillController@list');
    $router->get('bill/create', 'BillController@create');
    $router->get('bill/update', 'BillController@update');
    $router->get('bill/delete', 'BillController@delete');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('me', ['as' => 'users', 'uses' => 'UserController@me']);
    });
    
});

