<?php

use App\Tag;
use App\Post;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->truncate();
        $php = new Tag();
        $php->name = 'PHP';
        $php->slug = 'php';
        $php->save();
        
        $codeigniter = new Tag();
        $codeigniter->name = 'CodeIgniter';
        $codeigniter->slug = 'codeigniter';
        $codeigniter->save();

        $yii = new Tag();
        $yii->name = 'Yii';
        $yii->slug = 'yii';
        $yii->save();
        
        $laravel = new Tag();
        $laravel->name = 'Laravel';
        $laravel->slug = 'laravel';
        $laravel->save();
        
        $ruby =new  Tag();
        $ruby->name = 'Ruby on rail';
        $ruby->slug = 'ruby-on-rail';
        $ruby->save();
        
        $vuejs =new  Tag();
        $vuejs->name = 'Vuejs';
        $vuejs->slug = 'vuejs';
        $vuejs->save();
        
        $jquery =new  Tag();
        $jquery->name = 'Jquery';
        $jquery->slug = 'jquery';
        $jquery->save();
        
        $reactjs = new Tag();
        $reactjs->name = 'Reactjs';
        $reactjs->slug = 'reactjs';
        $reactjs->save();
        
        $tags = [
            $php->id ,
            $codeigniter->id,
            $yii->id ,
            $laravel->id,
            $ruby->id ,
            $vuejs->id ,
            $jquery->id,
            $reactjs->id
        ];

        foreach (Post::all() as $post) {
            shuffle($tags);
            for( $i = 0; $i < rand(0, (count($tags)-1)); $i++){
                $post->tags()->detach($tags[$i]);
                $post->tags()->attach($tags[$i]);
            }
        } 

        
    }
}
