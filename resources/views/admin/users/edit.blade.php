@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Users</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
          <div class="col-xs-9">
            
              <div class="box">
                <form id="form-submit" role="form" method="POST"  
                action="{{ route('users.update',["user"=>$user->id])}}" enctype="multipart/form-data" >
                  @csrf
                  @method("PUT")
                      <div class="box-body">
                      <div class="form-group @error('name') has-error  @enderror">
                          <label for="title">Name</label>
                          <input value="{{$user->name}}" type="text" name="name" placeholder="Enter Title here" id="name" class="form-control"
                          aria-labelledby="name">
                          @error('name')
                          <span class="help-block " id="title">
                              {{$errors->first('name')}}
                          </span>
                          @enderror
                      </div>

                      <div class="form-group @error('slug') has-error  @enderror">
                        <label for="slug">Slug</label>
                        <input value="{{$user->slug}}" type="text" name="slug" placeholder="Example: something-beautyful" id="slug" class="form-control"
                        aria-labelledby="slug">
                        @error('slug')
                        <span class="help-block " id="slug">
                            {{$errors->first('slug')}}
                        </span>
                        @enderror
                      </div>

  
                      <div class="form-group @error('email') has-error  @enderror">
                        <label for="email">Email</label>
                        <input value="{{$user->email}}" type="text" name="email"  class="form-control" id="email" aria-labelledby="email" placeholder="">

                        @error('email')
                        <span class="help-block " id="email">
                          {{$errors->first('email')}}
                        </span>
                        @enderror
                      </div>
  
                        <div class="form-group @error('password') has-error  @enderror">
                          <label for="password">Password</label>
                          <input type="password" name="password"  class="form-control" id="password" aria-labelledby="password" placeholder="">
  
                          @error('password')
                          <span class="help-block " id="password">
                            {{$errors->first('password')}}
                          </span>
                          @enderror
                        </div>

                        <div class="form-group @error('password_confirm') has-error  @enderror">
                          <label for="password_confirm">Password</label>
                          <input type="password" name="password_confirmation"  class="form-control" id="password_confirm" aria-labelledby="password_confirm" placeholder="">
  
                          @error('password_confirm')
                          <span class="help-block " id="password_confirm">
                            {{$errors->first('password_confirm')}}
                          </span>
                          @enderror
                        </div>

                        <div class="form-group @error('role') has-error  @enderror">
                          <label for="title">User Role</label>
                          <?php $roles = \App\Role::pluck('display_name', 'id');?>

                          <select class="form-control" name="role" id="role" aria-labelledby="role">
                              {{-- <option value="" selected>Select user role</option> --}}
                            @foreach ($roles as $key => $value)
                            
                            <option  value="{{$key}}" 
                              {{ ( $key == $user->roles()->first()->id) ? 'selected ' : '' }}
                            >
                               {{$value}}
                            </option>
                         
                            @endforeach
                          </select>

                          @error('role')
                          <span class="help-block " id="role">
                              {{$errors->first('role')}}
                          </span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="name">Bio</label>
                            <textarea class="form-control" name="bio" id="bio" rows="3" placeholder="Enter your bio" >{{$user->bio}}</textarea>
                        </div>
  
                      </div>
                      <!-- /.box-body -->
                     
                      <div class="box-footer">
                        <button class="btn btn-primary"  type="submit">Submit</button>
                      </div>
                   
                  </div>
            </div>
        
        </form>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->

  @endsection
  @section('scripts')
  <script>
    $('#title').on('blur', function(){
     var theTitle = this.value.toLowerCase().trim();
     var slugInput = $('#slug');
     var theSlug = theTitle.replace(/&/g, '-and-')
     .replace(/[^a-z0-9-]+/g, '-')
     .replace(/\-\-+/g, '-')
     .replace(/^-+|-+$/g, '');
     slugInput.val(theSlug);
   });
  </script>
  
  @endsection