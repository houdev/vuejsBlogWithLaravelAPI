<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

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

    public function store(Request $request)
    {
        $newArticle = new Article();

        $newArticle->title = $request->title;
        $newArticle->body = $request->body;
        $newArticle->save();

        //Return success message after adding new article
        return response()->json([
            "message" => "Article Has Been Added Successfully"
        ]);
    }

    public function update($id, Request $request)
    {
        $updateArticle = Article::find($id);
        $updateArticle->title = $request->title;
        $updateArticle->body  = $request->body;

        $updateArticle->save();

        //Return new articles list after the update
        return Article::all();
    }

    public function destroy($id)
    {
        $deleteArticle = Article::find($id);
        $deleteArticle->delete();

        //Return new articles list after the delete
        return Article::all();
    }


}
