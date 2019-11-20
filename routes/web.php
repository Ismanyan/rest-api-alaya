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
$router->post(
    'auth/login',
    [
        'uses' => 'AuthController@authenticate'
    ]
);

$router->post('auth/regist/{token}', 'AuthController@regist');

$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
        $router->get('users/[{id}]', 'UserController@show');
        $router->put('users/edit/{id}','UserController@edit');
        $router->post('users/create','UserController@create');
        $router->delete('users/delete/{id}', 'UserController@delete');
    }
);
