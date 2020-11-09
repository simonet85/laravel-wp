@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-9">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item"><a href="#">Users</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
              <div class="box">
                  <!-- form start -->
              <form id="form-submit" role="form" method="POST" action="{{ route('users.store')}}" enctype="multipart/form-data" >
                @csrf
                    <div class="box-body">
                    <div class="form-group @error('name') has-error  @enderror">
                        <label for="name">Name</label>
                        <input value="{{old('name')}}" type="text" name="name" placeholder="Enter your name" id="name" class="form-control"
                        aria-labelledby="name">
                        @error('name')
                        <span class="help-block " id="name">
                            {{$errors->first('name')}}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group @error('email') has-error  @enderror">
                      <label for="email">Email</label>
                      <input value="{{old('email')}}" type="text" name="email" placeholder="Enter your email" id="email" class="form-control"
                      aria-labelledby="email">
                      @error('name')
                      <span class="help-block " id="email">
                          {{$errors->first('email')}}
                      </span>
                      @enderror
                    </div>

                    <div class="form-group @error('password') has-error  @enderror">
                      <label for="password">Password</label>
                      <input value="{{old('password')}}" type="password" name="password" placeholder="Enter your password" id="password" class="form-control"
                      aria-labelledby="password">
                      @error('password')
                      <span class="help-block " id="password">
                          {{$errors->first('password')}}
                      </span>
                      @enderror
                    </div>

                  <div class="form-group @error('password-confirmation') has-error  @enderror">
                    <label for="title">Confirm Password</label>

                    <input value="{{old('password-confirmation')}}" type="password" name="password_confirmation" placeholder="Confirm your password" id="password-confirmation" class="form-control"
                    aria-labelledby="password-confirmation">

                    @error('password-confirmation')
                    <span class="help-block " id="password-confirmation">
                        {{$errors->first('password-confirmation')}}
                    </span>
                    @enderror

                  </div>

                  <div class="form-group @error('role') has-error  @enderror">
                    <label for="title">User Role</label>
                    <?php $roles = \App\Role::pluck('display_name', 'id');?>

                    <select class="form-control" name="role" id="role" aria-labelledby="role">
                        <option value="" selected>Select user role</option>
                      @foreach ($roles as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                      @endforeach
                    </select>

                    @error('role')
                    <span class="help-block " id="role">
                        {{$errors->first('role')}}
                    </span>
                    @enderror
                  </div>

                 
                </div>
              </div>
                    <!-- /.box-body --> 
              <div class="box-footer">
                  <button class="btn btn-primary"  type="submit">Create</button>
                  <a href="{{route('users.index')}}" class="btn btn-danger">Cancel</a>
              </div>
                 
              </div>
          </div>
          
        </form>
    </section>
    <!-- /.content -->

  @endsection
