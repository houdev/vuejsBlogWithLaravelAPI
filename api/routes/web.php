<?php
use \App\Article;
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

Route::get('addarticle', function () {

    //Add new Article

    // $newArticle = new Article();

    // $newArticle->title = 'Learning Vuejs Is Fun';
    // $newArticle->body = 'I Love Learning Vuejs';
    // $newArticle->save();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', function(){
    return 'hello Admin !';
})->middleware('auth.admin');
