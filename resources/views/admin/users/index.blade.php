@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item"><a href="#">Users</a></li>
        <li class="breadcrumb-item active">All Users</li>
      </ol>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header clearfix">
                    <div class="pull-left">
                        <a id="add-button" title="Add New" class="btn btn-success" href="{{route('users.create')}}"><i class="fa fa-plus-circle"></i> Add User</a>
                    </div>
                    
                </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">

                @if(session('trash-message'))
                
                  <div class="alert alert-danger">
                    <?php list($message, $postId) = session('trash-message'); ?>
                    <strong>{{$message}} </strong>  
                    <a href="{{route('users.restore',['id'=>$postId])}}" style="color:#ffff; text-decoration: none;" class="alert-link pull-right"
                      onclick="event.preventDefault();
                      document.getElementById('restore-form').submit();
                      " > <span class="glyphicon glyphicon-refresh"></span>Undo</a>

                    <form id="restore-form" action="{{route('users.restore',['id'=>$postId])}}" method="POST">
                      @csrf
                      @method("PUT")
                    </form>

                  </div>
                @endif

                @if( ! $users->count())
                <div class="alert alert-danger text-center">
                  No Users Found!
                </div>
                @else
                    @include('admin.users.table')
                @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
               {{-- add appends(Request::query()) method to fix the pagination --}}
                  {{$users->appends( Request::query() )->links()}}
                  
                  <div class=" pull-right">
                  <small> {{ $usersCount}} {{ str_plural('Post',  $usersCount)}}</small>
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