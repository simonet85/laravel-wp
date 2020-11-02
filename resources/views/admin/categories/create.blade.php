@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-9">
              <div class="box">
                  <!-- form start -->
              <form id="form-submit" role="form" method="POST" action="{{ route('categories.store')}}" enctype="multipart/form-data" >
                @csrf
                    <div class="box-body">
                    <div class="form-group @error('title') has-error  @enderror">
                        <label for="title">Title</label>

                        <input value="{{old('title')}}" type="text" name="title" placeholder="Enter Title here" id="title" class="form-control"
                        aria-labelledby="title">

                        @error('title')
                        <span class="help-block " id="title">
                            {{$errors->first('title')}}
                        </span>
                        @enderror

                      </div>

                      <div class="form-group @error('slug') has-error  @enderror">
                        <label for="slug">Slug</label>
                        <input value="{{old('slug')}}" type="text" name="slug"  class="form-control" id="slug" aria-labelledby="slug" placeholder="Example: web-design">

                        @error('slug')
                        <span class="help-block " id="slug">
                          {{$errors->first('slug')}}
                        </span>
                        @enderror
                      </div>

                    </div>
                    <!-- /.box-body -->
                   
                    <div class="box-footer">
                      <button class="btn btn-primary"  type="submit">{{$category->exists ? 'Update' : 'Add New'}}</button>
                    <a href="{{route('categories.index')}}" class="btn btn-danger">Cancel</a>
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