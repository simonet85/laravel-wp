@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-9">
              <div class="box">
                  <!-- form start -->
                  <form role="form">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" placeholder="Enter Title here" id="title" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" class="form-control">

                        <p class="help-block">Example block-level help text here.</p>
                      </div>
                      <div class="form-group">
                        <label for="body">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="5" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" rows="10" class="form-control"></textarea>
                      </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                      <button class="btn btn-primary" type="submit">Submit</button>
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