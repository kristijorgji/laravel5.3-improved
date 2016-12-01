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

/* This route is used to login with username and password and get a api token back */
Route::post('auth', 'Api\AuthController@authenticate');

//--------------------------------------------------------------------------//
//                          Test Route
//--------------------------------------------------------------------------//

/*
    * To access routes that use jwt middleware you need to use the header Authorization: Bearer {token}
    * You get the token in the route above, check tymon jwt for more configurations
*/

Route::get('/test', 'Api\AuthController@giveMeSomething')
    ->middleware((['jwt.auth', 'jwt.refresh', 'roles:Admin']));
