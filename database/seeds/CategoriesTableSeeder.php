<?php

use App\Post;
use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('categories')->truncate();
        DB::table('categories')->insert([

           [ "title"=>"Uncategorized",
            "slug"=>"uncategorized",],

           [ "title"=>"Advanced Javascript",
            "slug"=>"advanced-javascript",],

           [ "title"=>"Web Development",
            "slug"=>"web-development",],

           [ "title"=>"Advanced Java Programming",
            "slug"=>"advanced-java-programming",],

            [ "title"=>"Mobile Development",
            "slug"=>"mobile-development",],

            [ "title"=>"NodeJs React MongoDB",
            "slug"=>"nodejs-react-mongodb",],

        ]);

        foreach (Post::pluck('id') as $postId) { 
            $categories = Category::pluck('id');
            $categoriesId = rand(1, $categories->count()-1);
            $post = DB::table('posts')
                            ->where('id', $postId)
                           ->update(['category_id' => $categoriesId]);

        }
    }
}


