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

Route::post('users', 'UsersController@view')->middleware('auth:api');
Route::post('user/delete/{id}', 'UsersController@destroy')->middleware('auth:api');
Route::post('user/update/{id}', 'UsersController@update')->middleware('auth:api');
Route::post('user/store', 'UsersController@store')->middleware('auth:api');

Route::post('register', 'AuthApiController@register');
Route::post('login', 'AuthApiController@login');
Route::get('logout', 'AuthApiController@logout');
Route::post('me', 'AuthApiController@user');

Route::get('articles', 'ArticlesController@view');
Route::get('articles/{id}', 'ArticlesController@showById');
Route::get('myarticles', 'ArticlesController@myArticles');
Route::post('articles/add', 'ArticlesController@store');
Route::post('articles/update/{id}', 'ArticlesController@update');
Route::post('articles/delete/{id}', 'ArticlesController@destroy');
Route::post('articles/bulk/delete', 'ArticlesController@bulkDestroy');
Route::post('articles/search/', 'ArticlesController@searchArticletitle');

Route::get('comments', 'CommentsController@view');
Route::post('comment/add', 'CommentsController@store');
Route::get('comment/article/{id}', 'CommentsController@showByArticleId');

Route::post('picture/add','UploadController@store');

Route::get('/blog/statistics', function (){
    $users = \App\User::all();
    $articles = \App\Article::all();

    $usersCount = count($users);
    $artilcesCount = count($articles);

    return response( [
        'usersCount' => $usersCount,
        'artilcesCount' => $artilcesCount,
    ]);
});
