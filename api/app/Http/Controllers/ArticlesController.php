<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use JWTAuth;

class ArticlesController extends Controller
{
    public function view()
    {
        return Article::all();
    }

    public function showById($id)
    {
        return Article::find($id);
    }

    public function myArticles()
    {
        $CurrentUser = JWTAuth::parseToken()->authenticate();

        return Article::where('user_id', $CurrentUser->id)->get();

    }

    public function store(Request $request)
    {
        $CurrentUser = JWTAuth::parseToken()->authenticate();

        $this->authorize('create', Article::class);

        $newArticle = new Article();

        $newArticle->title = $request->title;
        $newArticle->body = $request->body;
        $newArticle->user_id = $CurrentUser->id;
        $newArticle->save();

        //Return success message after adding new article
        return response()->json([
            "message" => "Article Has Been Added Successfully",
            "articles" => Article::all()
        ]);
    }

    public function update($id, Request $request)
    {
        JWTAuth::parseToken()->authenticate();

        $updateArticle = Article::find($id);

        $this->authorize('update', $updateArticle);

        $updateArticle->title = $request->title;
        $updateArticle->body  = $request->body;

        $updateArticle->save();

        //Return new articles list after the update
        return Article::all();
    }

    public function destroy($id)
    {
        JWTAuth::parseToken()->authenticate();

        $deleteArticle = Article::find($id);

        $this->authorize('delete', $deleteArticle);

        $deleteArticle->delete();

        //Return new articles list after the delete
        return Article::all();
    }

    public function searchArticletitle(Request $request)
    {
        $searchTitle = $request->articleTitle;

        $articles = Article::where('title', 'LIKE', "%{$searchTitle}%")->orderBy('created_at', 'desc')->get();

        return $articles;
    }
}
