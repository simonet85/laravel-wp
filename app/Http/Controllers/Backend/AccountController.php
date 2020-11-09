<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.home.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.home.edit');
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
    public function edit(Request $request, $id)
    {
        $user = $request->user();
        return view('admin.home.edit', compact('user'));
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
        if ($request->isMethod("PUT") || $request->isMethod("PATCH")) {
            $rules = [
                "name"=>"required|string",
                "slug"=>"required|string",
                "email"=>"email|required|string",
                "password"=>"required_with:password_confirmation|confirmed|sometimes",
                "bio"=>"nullable",
            ];

            $user = User::findOrFail($id);
           
            $data = [
                "name"=>$request->name,
                "email"=>$request->email,
                "slug"=>Str::slug($request->slug),
                "bio"=>$request->bio,
                "password"=>bcrypt($request->password),
            ];
 
            $user->update( $data );
            
            notify()->success('Success!', 'User Profile has been Updated');
            return redirect()->back();
        }
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
