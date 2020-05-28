<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article1  = new Article();
        $article1->title = "sunt aut facere repellat provident occaecati excepturi optio reprehenderit";
        $article1->body = "quia et suscipit suscipit recusandae consequuntur expedita et cum reprehenderit molestiae ut ut quas totam nostrum rerum est autem sunt rem eveniet architecto";
        $article1->user_id = 1;
        $article1->save();

        $article2  = new Article();
        $article2->title = "qui est esse";
        $article2->body = "est rerum tempore vitae sequi sint nihil reprehenderit dolor beatae ea dolores neque fugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis qui aperiam non debitis possimus qui neque nisi nulla";
        $article2->user_id = 1;
        $article2->save();

        $article3  = new Article();
        $article3->title = "ea molestias quasi exercitationem repellat qui ipsa sit aut";
        $article3->body = "et iusto sed quo iure voluptatem occaecati omnis eligendi aut ad voluptatem doloribus vel accusantium quis pariatur molestiae porro eius odio et labore et velit aut";
        $article3->user_id = 1;
        $article3->save();

    }
}
