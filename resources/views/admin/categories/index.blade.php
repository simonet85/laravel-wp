@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header clearfix">
                    <div class="pull-left">
                        <a id="add-button" title="Add New" class="btn btn-success" href="{{route('categories.create')}}"><i class="fa fa-plus-circle"></i> Add New</a>
                    </div>
                    
                </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">

                @if(session('trash-message'))
                
                  <div class="alert alert-danger">
                    <?php list($message, $postId) = session('trash-message'); ?>
                    <strong>{{$message}} </strong>  
                    <a href="{{route('categories.restore',['id'=>$postId])}}" style="color:#ffff; text-decoration: none;" class="alert-link pull-right"
                      onclick="event.preventDefault();
                      document.getElementById('restore-form').submit();
                      " > <span class="glyphicon glyphicon-refresh"></span>Undo</a>

                    <form id="restore-form" action="{{route('categories.restore',['id'=>$postId])}}" method="POST">
                      @csrf
                      @method("PUT")
                    </form>

                  </div>
                @endif

                @if( ! $categories->count())
                <div class="alert alert-danger text-center">
                  No Posts Found!
                </div>
                @else
                    @include('admin.categories.table')
                @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
               {{-- add appends(Request::query()) method to fix the pagination --}}
                  {{$categories->appends( Request::query() )->links()}}
                  
                  <div class=" pull-right">
                  <small> {{ $categoriesCount}} {{ str_plural('Post',  $categoriesCount)}}</small>
                  </div>
              </div>
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
 @endsection

 @section('scripts')

     <script type="text/javascript">
       $('ul.pagination').addClass('no-margin pagination-sm');
      </script>

 @endsection