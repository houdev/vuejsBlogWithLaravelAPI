<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Article;
use JWTAuth;



class ArticlesController extends Controller
{
    public $paginteNumber = 5;

    public function view()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();

        $articlesList = [];

        //Add the username to the articles list
        foreach ($articles as $article){

            $newArticlesList = [
                'id'            => $article->id,
                'user_id'       => $article->user->id,
                'username'      => $article->user->name,
                'title'         => $article->title,
                'body'          => $article->body,
                'image'         => $article->image,
                'created_at'    => $article->created_at,
                'updated_at'    => $article->updated_at
            ];

            $articlesList[] = $newArticlesList ;
        }

        return $this->paginate($articlesList, $perPage = $this->paginteNumber, $page = null, $options = []);
    }

    public function showById($id)
    {
        return Article::find($id);
    }

    public function myArticles()
    {
        $CurrentUser = JWTAuth::parseToken()->authenticate();

        return Article::where('user_id', $CurrentUser->id)->orderBy('created_at', 'desc')->get();

    }

    public function store(Request $request)
    {
        $CurrentUser = JWTAuth::parseToken()->authenticate();

        $this->authorize('create', Article::class);

        $validateArticle = Validator::make($request->all(),[
            'title' => 'required|min:10',
            'body' => 'required|min:20',
        ]);

        if($validateArticle->fails()){
            return response()->json([
                'error' => 'Adding new article failed!, please check the title & body length'
            ]);
        }

        $image = $request->file('image');
        $storePath = public_path() . '/articles/images/';
        $imageName = $image->getClientOriginalName();

        $image->move($storePath, $imageName);
        $imageURL = url('/articles/images/' . $imageName);

        $newArticle = new Article();

        $newArticle->title = $request->title;
        $newArticle->body = $request->body;
        $newArticle->image = $imageURL;
        $newArticle->user_id = $CurrentUser->id;
        $newArticle->save();

        //Return success message after adding new article
        return response()->json([
            "message" => "Article Has Been Added Successfully",
            "articles" => Article::orderBy('created_at', 'desc')->paginate($this->paginteNumber)
        ]);
    }

    public function update($id, Request $request)
    {
        JWTAuth::parseToken()->authenticate();

        $updateArticle = Article::find($id);

        $this->authorize('update', $updateArticle);

        $validateArticle = Validator::make($request->all(),[
            'title' => 'required|min:10',
            'body' => 'required|min:20',
        ]);

        if($validateArticle->fails()){
            return response()->json([
                'error' => 'Updating the article failed!, please check the title & body length'
            ]);
        }

        $image = $request->file('image');
        $storePath = public_path() . '/articles/images/';
        $imageName = $image->getClientOriginalName();

        $image->move($storePath, $imageName);
        $imageURL = url('/articles/images/' . $imageName);

        $updateArticle->title = $request->title;
        $updateArticle->body  = $request->body;
        $updateArticle->image  = $imageURL;

        $updateArticle->save();

        //Return new articles list after the update
        return Article::orderBy('created_at', 'desc')->paginate($this->paginteNumber);
    }

    public function destroy($id)
    {
        JWTAuth::parseToken()->authenticate();

        $deleteArticle = Article::find($id);

        $this->authorize('delete', $deleteArticle);

        $deleteArticle->delete();

        //Return new articles list after the delete
        return Article::orderBy('created_at', 'desc')->paginate($this->paginteNumber);
    }

    public function bulkDestroy(Request $request)
    {
        JWTAuth::parseToken()->authenticate();

        //Get articles ids
        $data = $request->json()->all();
        $articlesIds = $data['articlesIds'];

        foreach ($articlesIds as $k => $v ){
            $article = Article::find($v);
            $article->delete();
        }

        return response()->json([
            "message" => "Articles has been deleted successfully."
        ]);
    }

    public function searchArticletitle(Request $request)
    {
        $searchTitle = $request->articleTitle;

        $articles = Article::where('title', 'LIKE', "%{$searchTitle}%")
                            ->orderBy('created_at', 'desc')
                            ->paginate($this->paginteNumber);

        return $articles;
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
