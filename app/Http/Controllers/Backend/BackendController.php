<?php

namespace App\Http\Controllers\Backend;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BackendController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $limit = 4;
    public function index()
    {
        //Eagger loading-model injection -accessor and mutator
        
        $posts = Post::with('category', 'author')->latest()->paginate($this->limit);
        $countItem = Post::count();
       
        return view('admin.index')->with('posts', $posts)
                                 ->with('countItem', $countItem);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.form')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    dd($request->all());
        $this->validate($request,[
            "title"=>"required|string",
            "slug"=>"required|string|unique:posts",
            "published_at" => "date|nullable",
            "category_id" => "required",
            "excerpt"=>"required|string",
            "image"=>"mimes:jpeg,png,bmp,jpg|nullable",
            "body"=>"required|string",
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file("image");
            $fileName = $image->getClientOriginalName();
            $destination = public_path('/assets/frontend/img');
            $successUpload = $image->move($destination, $fileName);
            // video 43
            if ($successUpload) {
                $fileExtension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$fileExtension} ", "_thumb.{$fileExtension}",  $fileName);
                Image::make( $destination.'/'.$fileName)
                        ->resize(250, 170)
                        ->save( $destination.'/'.$thumbnail);
            }
        }

      
        $create = Post::create([
            "title"=>$request->title,
            "slug"=>$request->slug,
            "published_at" => $request->published_at,
            "category_id" => $request->category_id,
            "excerpt"=>$request->excerpt,
            "body"=>$request->body,
            "author_id"=>auth()->user()->id,
            "image" => $fileName,
        ]);

        // $request->user()->posts()->create();

        // session()->flash('success', 'Post Created');
        notify()->success('Success!', 'Post Created');
        return redirect()->route('admin.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $post = Post::findOrFail($id);
       
        $categories = Category::all();
        // dd($categories);
        return view('admin.edit',compact('post', 'categories' ));
                                
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
        $rules = [
            "title"=>"required|string",
            "slug"=>"required|string|unique:posts",
            "published_at" => "date|nullable",
            "category_id" => "required",
            "excerpt"=>"required|string",
            "image"=>"mimes:jpeg,png,bmp,jpg|nullable",
            "body"=>"required|string",
        ];
        if ($request->isMethod('PATCH') || $request->isMethod('PUT')) {
            
           $rules["slug"] = "required|string";
            // dd( $rules["slug"]);
           $request->validate($rules);
        }


        if ($request->hasFile('image')) {
            $image = $request->file("image");
            $fileName = $image->getClientOriginalName();
            $destination = public_path('/assets/frontend/img');
            $successUpload = $image->move($destination, $fileName);
            // video 43
            if ($successUpload) {
                $fileExtension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$fileExtension} ", "_thumb.{$fileExtension}",  $fileName);
                Image::make( $destination.'/'.$fileName)
                        ->resize(250, 170)
                        ->save( $destination.'/'.$thumbnail);
            }
        }

        $post = Post::find($id);
        $post->update([
            "title"=>$request->title,
            "slug"=>$request->slug,
            "published_at" => $request->published_at,
            "category_id" => $request->category_id,
            "excerpt"=>$request->excerpt,
            "body"=>$request->body,
            "author_id"=>auth()->user()->id,
            "image" => $fileName,
        ]);

        // $request->user()->posts()->create();

        // session()->flash('success', 'Post Created');
        notify()->success('Success!', 'Post Updated');
        return redirect()->route('admin.index');

    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        // dd($id);   
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        notify()->info('Post removed trash ...');
        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Post::findOrfail($id)->delete();
        // session()->flash('trash-message', 'Post Moved to Trash ...');
        return redirect('admin')->with('trash-message',['post moved to Trash ...',$id]);
    }
}
