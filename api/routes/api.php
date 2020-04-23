<?php
header('Access-Control-Allow-Origin : *');
header('Access-Control-Allow-Headers : Content-Type,X-Auth-Token,Authorization,Origin');
header('Access-Control-Expose-Headers : X-Auth-Token, Authorization');
header('Access-Control-Allow-Methods :GET, POST, PUT, DELETE, OPTIONS');

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'APILoginController@login');

Route::get('articles', 'ArticlesController@view');
Route::get('articles/{id}', 'ArticlesController@showById');
Route::get('myarticles', 'ArticlesController@myArticles');
Route::post('articles/add', 'ArticlesController@store');
Route::post('articles/update/{id}', 'ArticlesController@update');
Route::post('articles/delete/{id}', 'ArticlesController@destroy');

Route::get('logout', 'APILogoutController@logout');
