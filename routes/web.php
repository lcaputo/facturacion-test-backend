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

    $router->group(['middleware' => 'auth'], function () use ($router) {

        $router->get('me', ['as' => 'user', 'uses' => 'UserController@me']);
        $router->get('user/{id}', 'UserController@findById');

        $router->get('product/list', 'ProductController@list');
        $router->get('product/{id}', 'ProductController@detail');
        $router->post('product/create', 'ProductController@create');
        $router->patch('product/update/{id}', 'ProductController@update');
        $router->delete('product/delete/{id}', 'ProductController@delete');
    
        $router->get('bill/list', 'BillController@list');
        $router->get('bill/{id}', 'BillController@detail');
        $router->post('bill/create', 'BillController@create');
        $router->patch('bill/update/{id}', 'BillController@update');
        $router->delete('bill/delete/{id}', 'BillController@delete');
    
        $router->get('bill/detail/list', 'BillDetailController@list');
        $router->get('bill/detail/{id}', 'BillDetailController@detail');
        $router->post('bill/detail/create', 'BillDetailController@create');
        $router->patch('bill/detail/update/{id}', 'BillDetailController@update');
        $router->delete('bill/detail/delete/{id}', 'BillDetailController@delete');
    
        $router->get('client/list', 'ClientController@list');
        $router->get('client/{cc}', 'ClientController@findByCC');        
        $router->post('client/create', 'ClientController@create');
        $router->patch('client/update/{id}', 'ClientController@update');
        $router->delete('client/delete/{id}', 'ClientController@delete');

    });
    
});

