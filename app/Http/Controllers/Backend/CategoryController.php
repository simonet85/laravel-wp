<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $categories = Category::with('posts')->orderBy('title')->paginate($this->limit);
        $categoriesCount = Category::count();
        return view('admin.categories.index', compact('categories', 'categoriesCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('admin.categories.create', compact('category'));
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
            "title"=>"required|string",
            "slug"=>"required|string|unique:categories",
           
        ]);
 
        $create = Category::create([
            "title"=>$request->title,
            "slug"=>$request->slug,
        ]);

        // $request->user()->posts()->create();

        // session()->flash('success', 'Post Created');
        notify()->success('Category has been Created');
        return redirect()->route('categories.index');


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
          $category = Category::findOrFail($id);
       
          $categories = Category::all();
          // dd($categories);
          return view('admin.categories.edit',compact('category', 'categories' ));
                                  
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
            "slug"=>"required|string|unique:catgories",
        ];
        if ($request->isMethod('PATCH') || $request->isMethod('PUT')) {
            
           $rules["slug"] = "required|string";
            // dd( $rules["slug"]);
           $request->validate($rules);
        }

        $category = Category::findOrFail($id);
       
        $data = [
            "title"=>$request->title,
            "slug"=>$request->slug,
        ];
       
        $category->update( $data );

        // $request->user()->posts()->create();

        // session()->flash('success', 'Post Created');
        notify()->success('Success!', 'Category has been Updated');
        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $categoryPostCount = $category->posts->count();

        if( $categoryPostCount > 0){
            
            notify()->warning('Warning!', 'Can\'t delete a category that have more that one posts.');
            return redirect('categories');
        }else{
            $category->delete();
       
            
            notify()->success('Success!', 'Category has been Deleted successfully');
            return redirect('categories');
        }
       
    }
}
