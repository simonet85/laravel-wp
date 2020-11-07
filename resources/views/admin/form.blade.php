@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Blog</a></li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Add</li>
          </ol>
          <div class="col-xs-9">
              <div class="box">
                  <!-- form start -->
              <form id="form-submit" role="form" method="POST" action="{{ route('admin.store')}}" enctype="multipart/form-data" >
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

                      <div class="form-group @error('excerpt') has-error  @enderror">
                        <label for="body">Excerpt</label>
                        <textarea value="{{old('excerpt')}}" name="excerpt" id="excerpt" rows="5" class="form-control excerpt" aria-labelledby="excerpt" placeholder="Enter a short description of your post."></textarea>
                        @error('excerpt')
                        <span class="help-block " id="excerpt" class="sr-only">
                          {{$errors->first('excerpt')}}
                        </span>
                        @enderror
                      </div>

                      <div class="form-group @error('body') has-error  @enderror">
                        <label for="body">Body</label>
                        <textarea value="{{old('body')}}" name="body" id="body" rows="10" class="form-control " aria-labelledby="body"
                          placeholder="Enter your complete post here."></textarea>
                          @error('body')
                          <span class="help-block " id="body">
                            {{$errors->first('body')}}
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
          <div class="col-md-3">
              <div class="box">
                  <div class="box-header with-border">
                      <h3 class="box-title">Publish</h3>
                  </div>
                  <div class="box-body">
                    <div class="form-group @error('published_at') has-error  @enderror">
                      <label for="published_at">Published date</label>
                      {{-- <div class='input-group date' id='datetimepicker1'> --}}
                        <input value="{{old('published_at')}}" type="date" name="published_at"  class="form-control" id="published_at" aria-labelledby="published_at" placeholder="Choose the publication date">

                        {{-- <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div> --}}

                      @error('published_at')
                      <span class="help-block " id="published_at">
                        {{$errors->first('published_at')}}
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="box-footer clearfix">
                      <div class="pull-left">
                          <a href="{{ route('admin.store')}}" onclick="draftFunction(event);" class="btn btn-warning">Save Draft</a>
                      </div>
                      <div class="pull-right">
                          <a href="{{ route('admin.store')}}" class="btn btn-primary" 
                          onclick="event.preventDefault(); 
                          document.getElementById('form-submit').submit();">Publish</a>
                      </div>
                  </div>
              </div>

              <div class="box">
                  <div class="box-header with-border">
                      <h3 class="box-title">Category</h3>
                  </div>
                  <div class="form-group @error('category_id') has-error  @enderror">
                    <select class="form-control" name="category_id" id="category_id" aria-labelledby="category_id">
                      <option value=" " selected>Choose a category</option>
                      @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->title}}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                    <span class="help-block " id="category_id">
                      {{$errors->first('category_id')}}
                    </span>
                    @enderror
                  </div>
                 
              </div>
              <div class="box">
                  <div class="box-header with-border">
                      <h3 class="box-title">Feature Image</h3>
                  </div>
                  <div class="box-body text-center">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                            <img src="https://via.placeholder.com/200x150?text=No+Image"  alt="feature image">
                          </div>
                          <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                          <div>
                            <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new btn btn-primary">Select image</span><span class="fileinput-exists btn btn-warning">Change</span><input type="file" name="image"></span>
                            <a href="#" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                      </div>
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
  

 <script>
   var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
   var simplemde2 = new SimpleMDE({ element: $("#body")[0] });
 </script>
<script>
  function draftFunction(){
    event.preventDefault();
    document.getElementById('published_at').value = 'null';
    document.getElementById('form-submit').submit();
  }
</script>

<script type="text/javascript">
  $(function () {
      $('#datetimepicker1').datetimepicker(
        {
          format: 'DD/MM/YYYY HH:mm:ss',
          showClear: true,
        }
      );
  });
</script>
  @endsection