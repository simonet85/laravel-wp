@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item"><a href="#">Tags</a></li>
        <li class="breadcrumb-item active">Home</li>
      </ol>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header clearfix">
                    <div class="pull-left">
                        <a id="add-button" title="Add New" class="btn btn-success" href="{{route('tags.create')}}"><i class="fa fa-plus-circle"></i> Add New</a>
                    </div>
                    
                </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">

                @if(session('trash-message'))
                
                  <div class="alert alert-danger">
                    <?php list($message, $postId) = session('trash-message'); ?>
                    <strong>{{$message}} </strong>  
                    <a href="{{route('tags.restore',['tag'=>$postId])}}" style="color:#ffff; text-decoration: none;" class="alert-link pull-right"
                      onclick="event.preventDefault();
                      document.getElementById('restore-form').submit();
                      " > <span class="glyphicon glyphicon-refresh"></span>Undo</a>

                    <form id="restore-form" action="{{route('tags.restore',['id'=>$postId])}}" method="POST">
                      @csrf
                      @method("PUT")
                    </form>

                  </div>
                @endif

                @if( ! $tags->count())
                <div class="alert alert-danger text-center">
                  No Posts Found!
                </div>
                @else
                    @include('admin.tags.table')
                @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
               {{-- add appends(Request::query()) method to fix the pagination --}}
                  {{$tags->appends( Request::query() )->links()}}
                  
                  <div class=" pull-right">
                  <small> {{ $tagsCount}} {{ str_plural('Tag',  $tagsCount)}}</small>
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