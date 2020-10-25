<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Resetting the table column
        DB::table('posts')->truncate();

        //Adding posts to the posts table
        $posts = [];
        $faker = Factory::create();
        for ($i=1; $i <= 10; $i++) { 
            $image = 'Post_Image_'.rand(1,5).'_thumb'.'.jpg';
            $date = date('Y-m-d H:i:s', strtotime("2020-10-25 19:45:00 +{$i} days"));
            $posts[] = [
                'author_id'=> rand(1, 3),
                'title'=> $faker->sentence( rand(8, 12)),
                'slug'=> $faker->slug(),
                'excerpt'=>$faker->text(rand(255, 300)),
                'body'=>$faker->paragraphs(rand(10, 15), true),
                'image'=> rand(0,1) == 1 ? $image : NULL,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }
        // dd($posts);
        DB::table('posts')->insert($posts);


    }
}
