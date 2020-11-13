@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item"><a href="#">Tags</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
        <div class="row">
          <div class="col-xs-9">
              <div class="box">
                  <!-- form start -->
              <form id="form-submit" role="form" method="POST" action="{{ route('tags.update',["tag"=>$tag->id])}}" enctype="multipart/form-data" >
                @csrf
                @method("PUT")
                    <div class="box-body">
                    <div class="form-group @error('name') has-error  @enderror">
                        <label for="title">Name</label>

                        <input value="{{$tag->name}}" type="text" name="name" placeholder="Enter name here" id="title" class="form-control"
                        aria-labelledby="title">

                        @error('name')
                        <span class="help-block " id="title">
                            {{$errors->first('name')}}
                        </span>
                        @enderror

                      </div>

                      <div class="form-group @error('slug') has-error  @enderror">
                        <label for="slug">Slug</label>
                        <input value="{{$tag->slug}}" type="text" name="slug"  class="form-control" id="slug" aria-labelledby="slug" placeholder="Example: web-design">

                        @error('slug')
                        <span class="help-block " id="slug">
                          {{$errors->first('slug')}}
                        </span>
                        @enderror
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