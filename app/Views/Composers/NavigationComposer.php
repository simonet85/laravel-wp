<?php
namespace App\Views\Composers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\View\View;

class NavigationComposer{

    public function compose(View $view){
       $this->composeCategories($view);
       $this->composePopularPosts($view);
       $this->composeTags($view);
       $this->composeArchives($view);
    }

    public function composeCategories( View $view ){

        $categories = Category::with(['posts' => function($query) {
            $query->published();
        }])->orderBy('title', 'asc')->get();
    
        $view->with('categories', $categories);
    }

    public function composePopularPosts( View $view ){

        $popularPosts = Post::published()->popular()->take(3)->get();
        $view->with('popularPosts', $popularPosts);

    }

    private function composeTags( View $view){
        $tags = Tag::has('posts')->get();
        $view->with('tags', $tags);
    }

    private function composeArchives( View $view){
        $archives =  Post::selectRaw('count(id) as post_count, year(published_at) year, monthname(published_at) month')
        ->published()
        ->groupBy('year', 'month')
        ->orderByRaw('min(published_at) desc')
        ->get();
        $view->with('archives', $archives);
       
    }
}
