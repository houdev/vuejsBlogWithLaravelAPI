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

    public function showByArticleId($id)
    {
        $comments = Comment::where('article_id', $id)->get();
        $commentsList = [];

        //Add the username to the comments list
        foreach ($comments as $comment){

            $newCommentsList = [
                'id'            => $comment->id,
                'comment'       => $comment->comment,
                'user_id'       => $comment->user->id,
                'username'      => $comment->user->name,
                'article_id'    => $comment->article->id,
                'created_at'    => $comment->created_at
            ];

            $commentsList[] = $newCommentsList ;
        }

        return $commentsList;
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
