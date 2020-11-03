<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $users = User::with('posts')->orderBy('name')->paginate($this->limit);
        
        $usersCount = User::count();
        
        return view('admin.users.index', compact('users', 'usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('admin.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "name"=>"required|string",
            "email"=>"required|string|unique:users",
            "password"=>"required|confirmed",
        ];

        $request->validate( $rules );
       
        $data = [
            "name"=>$request->name,
            "email"=>$request->email,
            "slug"=>Str::slug($request->name),
            "password"=>bcrypt($request->password),
        ];
       $user = new User();
       $user->create( $data );

        notify()->success('Success!', 'User has been Updated');
        return redirect('users');

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
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
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
                "email"=>"email|required|string",
                "password"=>"required_with:password_confirmation|confirmed",
            ];
            # code...
            $request->validate(  $rules  );
            $user = User::findOrFail($id);
           
            $data = [
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>$request->password,
            ];
           
            $user->update( $data );
            notify()->success('Success!', 'User has been Updated');
            return redirect('users');
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
        $user = User::findOrfail($id);
        $userPostCount = $user->posts->count();

        if( $userPostCount > 0){
            
            notify()->warning('Warning!', 'Can\'t delete a user that have more that one posts.');
            return redirect('users');
        }else{
            $user->delete();
       
            
            notify()->success('Success!', 'User has been Deleted successfully');
            return redirect('users');
        }
    }
}
