<?php
header('Access-Control-Allow-Origin : *');
header('Access-Control-Allow-Headers : Content-Type,X-Auth-Token,Authorization,Origin');
header('Access-Control-Allow-Methods :GET, POST, PUT, DELETE, OPTIONS');

use Illuminate\Http\Request;
use \App\Article;

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

Route::get('articles', function(){
    $articles = Article::all();

    return $articles;
});

Route::get('articles/{id}', function($id){
    $articles = Article::find($id);

    return $articles;
});
Route::post('articles/add', function(Request $request){

    //Add new Article
    $newArticle = new Article();

    $newArticle->title = $request->title;
    $newArticle->body = $request->body;
    $newArticle->save();

    //Return success message after adding it
    
    return response()->json([
        "message" => "Article Has Been Added Successfully"
    ]);
});

Route::post('articles/delete/{id}', function($id){

    //delete Article
    $deleteArticle = Article::find($id);
    $deleteArticle->delete();

    //Return new articles list after the delete
    $articles = Article::all();
    return $articles;
});

Route::post('articles/update/{id}', function($id, Request $request){

    //Update Article
    $updateArticle = Article::find($id);
    $updateArticle->title = $request->title;
    $updateArticle->body  = $request->body;

    $updateArticle->save();

    //Return new articles list after the update
    $articles = Article::all();
    return $articles;
});
