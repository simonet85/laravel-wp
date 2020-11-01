@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header clearfix">
                    <div class="pull-left">
                        <a id="add-button" title="Add New" class="btn btn-success" href="{{route('admin.create')}}"><i class="fa fa-plus-circle"></i> Add New</a>
                    </div>
                    {{-- <div class="pull-right">
                    <form accept-charset="utf-8" method="post" class="form-inline" id="form-filter" action="#">
                      @csrf
                        <div class="input-group">
                            <input type="hidden" name="search">
                            <input type="text" name="keywords" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search..." value="">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default search-btn" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                   
                    </div> --}}

                    <div class="pull-right">
                      <a href="{{url('/trash/?status=all')}}" class="btn btn-sm btn-primary">All</a>
                      <a href="{{url('/trash/?status=trash')}}" class="btn btn-sm btn-primary">Trash</a>
                    </div>
                </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">

                @if(session('trash-message'))
                
                  <div class="alert alert-danger">
                    <?php list($message, $postId) = session('trash-message'); ?>
                    <strong>{{$message}} </strong>  
                    <a href="{{route('admin.restore',['id'=>$postId])}}" style="color:#ffff; text-decoration: none;" class="alert-link pull-right"
                      onclick="event.preventDefault();
                      document.getElementById('restore-form').submit();
                      " > <span class="glyphicon glyphicon-refresh"></span>Undo</a>

                    <form id="restore-form" action="{{route('admin.restore',['id'=>$postId])}}" method="POST">
                      @csrf
                      @method("PUT")
                    </form>

                  </div>
                @endif

                @if( ! $posts->count())
                <div class="alert alert-danger text-center">
                  No Posts Found!
                </div>
                @else
                  @if( $onlyTrashed )
                    @include('admin.table-trashed')
                  @else
                    @include('admin.table')
                  @endif
                @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
               
                  {{$posts->links()}}
                  
                  <div class=" pull-right">
                  <small> {{ $countItem}} {{ str_plural('Post',  $countItem)}}</small>
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

     <script>
       function confirmDelete (event){
        
       
       }
      
     </script>
 @endsection