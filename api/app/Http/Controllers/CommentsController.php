<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use JWTAuth;

class CommentsController extends Controller
{
    public function view()
    {
        return Comment::all();
    }
    public function store(Request $request)
    {
        $CurrentUser = JWTAuth::parseToken()->authenticate();

        $newComment = new Comment();

        $newComment->comment = $request->comment;
        $newComment->user_id = $CurrentUser->id;
        $newComment->article_id = $request->articleId;
        $newComment->save();
    }
}
