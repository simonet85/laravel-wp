<?php

namespace App\Http\Controllers\Backend;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $tags = Tag::with('posts')->orderBy('name')->paginate($this->limit);
        $tagsCount = Tag::count();
        return view('admin.tags.index', compact('tags', 'tagsCount'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = new Tag();
        return view('admin.tags.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name"=>"required|string",
            "slug"=>"required|string|unique:tags",
           
        ]);
 
        $create = Tag::create([
            "name"=>$request->name,
            "slug"=>$request->slug,
        ]);

        // $request->user()->posts()->create();

        // session()->flash('success', 'Post Created');
        notify()->success('Tag has been Created');
        return redirect()->route('tags.index');
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
    public function edit( Request $request, $id )
    {
           // dd($id);
           $tag = Tag::findOrFail($id);
       
           $tags = Tag::all();
           // dd($categories);
           return view('admin.tags.edit',compact('tag', 'tags' ));
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
            "name"=>"required|string",
            "slug"=>"required|string|unique:tags",
        ];
        if ($request->isMethod('PATCH') || $request->isMethod('PUT')) {
            
           $rules["slug"] = "required|string";
            // dd( $rules["slug"]);
           $request->validate($rules);
        }

        $tag = Tag::findOrFail($id);
       
        $data = [
            "name"=>$request->name,
            "slug"=>$request->slug,
        ];
       
        $tag->update( $data );

        // $request->user()->posts()->create();

        // session()->flash('success', 'Post Created');
        notify()->success('Success!', 'Tag has been Updated');
        return redirect('tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrfail($id);
        $tagPostCount = $tag->posts->count();

        if( $tagPostCount > 0){
            
            notify()->warning('Warning!', 'Can\'t delete a Tag that have more that one posts.');
            return redirect('categories');
        }else{
            $tag->delete();
       
            
            notify()->success('Success!', 'Tag has been Deleted successfully');
            return redirect('tags');
        }
       
    }
}
