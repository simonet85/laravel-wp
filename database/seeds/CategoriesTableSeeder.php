<?php

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

           [ "title"=>"Web Design",
            "slug"=>"web-design",],

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

        for ($post_id = 1; $post_id  <= 10 ; $post_id++) { 
           
            $post = DB::table('posts')
                            ->where('id', $post_id)
                           ->update(['category_id' => rand(1, 6)]);

        }
    }
}
