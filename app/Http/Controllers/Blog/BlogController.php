<?php

namespace App\Http\Controllers\Blog;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $limit = 4; 
    public function index()
    {
        $categories = Category::with(['posts' => function($query){
            $query->published();
        }])->orderBy('title', 'asc')->get();

       
        $posts = Post::with('author')->latestFirst()
                                     ->filter( request('search') )
                                     ->published()
                                     ->simplePaginate($this->limit);
      
        return view('blog.index')->with('posts', $posts)
                           ->with('categories', $categories);
        // \DB::enableQueryLog();
        //  view('blog.index')->with('posts', $posts)->render();
        // dd(\DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $categories = Category::with(['posts' => function($query){
        //     $query->published();
        // }])->orderBy('title', 'asc')->get();
        
        // $post  = Post::published()->findOrFail($id);
        $post->increment( 'view_count' );
        return view('blog.post')->with('post', $post)
                                ->with('categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
