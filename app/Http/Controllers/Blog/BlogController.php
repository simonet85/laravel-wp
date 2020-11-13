<?php

namespace App\Http\Controllers\Blog;

use App\Tag;
use App\Post;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

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
                                     ->filter( request(['search', 'month', 'year']) )
                                     ->published()
                                     ->simplePaginate($this->limit);
      
        return view('blog.index')->with('posts', $posts)
                           ->with('categories', $categories);
        // \DB::enableQueryLog();
        //  view('blog.index')->with('posts', $posts)->render();
        // dd(\DB::getQueryLog());
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function tag( Tag $tag )
    {
        $tagName = $tag->name;

        $posts = Post::with('author')->latestFirst()
                                     ->filter( request('search') )
                                     ->published()
                                     ->simplePaginate($this->limit);
      
        return view('blog.index')->with('posts', $posts)
                           ->with('tagName', $tagName);
        // \DB::enableQueryLog();
        //  view('blog.index')->with('posts', $posts)->render();
        // dd(\DB::getQueryLog());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comment(Post $post, Request $request)
    {
        
        $request->validate([
            "author_name" =>"required|string",
            "author_email" =>"email" ,
            "author_url" => "nullable",
            "body" =>"required",
        ]);

        $data = $request->all();
        $post = $post->find($request->get('post_id'));
       
        $data["post_id"] = $post->id;
       
        $comment = Comment::create($data);

        if($comment instanceof Model){
            notify()->success('Success!', 'Comment Added');
            return redirect()->back();
        }else{

            notify()->error('Error!', 'Comment Can\'t Added');
            return redirect()->route('blog.show',['blog'=>$post->id]);
        }
      
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
        $categories = Category::with(['posts' => function($query){
        $query->published();
        }])->orderBy('title', 'asc')->get();
        
        // $post  = Post::published()->findOrFail($id);
        $post->increment( 'view_count' );
        $postComments = $post->comments()->simplePaginate(3);
        return view('blog.show')->with('post', $post)
                                ->with('categories',$categories)
                                ->with('postComments',$postComments);
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
