@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-9">
              <div class="box">
                  <!-- form start -->
              <form role="form" method="POST" action="{{ route('admin.store')}}" enctype="multipart/form-data" >
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

                      <div class="form-group @error('published_at') has-error  @enderror">
                        <label for="published_at">Published date</label>
                        <input value="{{old('published_at')}}" type="date" name="published_at"  class="form-control" id="published_at" aria-labelledby="published_at" placeholder="Choose the publication date">

                        @error('published_at')
                        <span class="help-block " id="published_at">
                          {{$errors->first('published_at')}}
                        </span>
                        @enderror
                      </div>
                      <div class="form-group @error('category_id') has-error  @enderror">
                        <label for="category_id">Categories</label>
                        <select class="form-control" name="category_id" id="category_id" aria-labelledby="category_id">
                          <option >Choose a category</option>
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
                     
                      <div class="form-group @error('excerpt') has-error  @enderror">
                        <label for="body">Excerpt</label>
                        <textarea value="{{old('excerpt')}}" name="excerpt" id="excerpt" rows="5" class="form-control " aria-labelledby="excerpt" placeholder="Enter a short description of your post."></textarea>
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

                      <div class="form-group @error('image') has-error  @enderror">
                        <label for="image">image</label>
                        <input type="file" name="image"  class="form-control" id="image" aria-labelledby="image" >

                        @error('image')
                        <span class="help-block " id="image">
                          {{$errors->first('image')}}
                        </span>
                        @enderror
                      </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                      <button class="btn btn-primary"  type="submit">Submit</button>
                    </div>
                  </form>
                </div>
          </div>
          <div class="col-md-3">
              <div class="box">
                  <div class="box-header with-border">
                      <h3 class="box-title">Publish</h3>
                  </div>
                  <div class="box-body">
                      <div class="form-group">
                        <label for="published_at">Publish date</label>
                        <input type="text" class="form-control">
                      </div>
                  </div>
                  <div class="box-footer clearfix">
                      <div class="pull-left">
                          <a href="#" class="btn btn-default">Save Draft</a>
                      </div>
                      <div class="pull-right">
                          <a href="#" class="btn btn-primary">Publish</a>
                      </div>
                  </div>
              </div>
              <div class="box">
                  <div class="box-header with-border">
                      <h3 class="box-title">Category</h3>
                  </div>
                  <div class="box-body">
                      <div class="radio">
                          <label>
                            <input type="radio" name="category" id="category-1" value="option1">
                            Web Programming
                          </label>
                      </div>
                      <div class="radio">
                          <label>
                            <input type="radio" name="category" id="category-2" value="option1">
                            Web Design
                          </label>
                      </div>
                      <div class="radio">
                          <label>
                            <input type="radio" name="category" id="category-3" value="option1">
                            Java
                          </label>
                      </div>
                  </div>
              </div>
              <div class="box">
                  <div class="box-header with-border">
                      <h3 class="box-title">Feature Image</h3>
                  </div>
                  <div class="box-body text-center">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                            <img src="http://placehold.it/200x200" width="100%" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                            <input type="file" name="...">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->

  @endsection