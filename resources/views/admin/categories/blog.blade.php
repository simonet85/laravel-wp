@extends('layouts.admin-master')
@section('admin-content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Categories</a></li>
            <li class="breadcrumb-item active">Home</li>
          </ol>
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a id="add-button" title="Add New" class="btn btn-success" href="{{route('admin.create')}}"><i class="fa fa-plus-circle"></i> Add New</a>
                    </div>
                    <div class="pull-right">
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
                    </div>
                </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                @if( ! $posts->count())
                <div class="alert alert-danger text-center">
                  No Posts Found!
                </div>
                @else
                <table class="table table-bordered table-condesed">
                  <thead>
                      <tr>
                        <th>Action</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th width="170">Date</th>
                      </tr>
                  </thead>
                  <tbody>
                   
                    @foreach($posts as $post)
                      <tr>
                        <td width="70">
                         
                        <a title="Edit" class="btn btn-xs btn-default edit-row" 
                        href="{{ route('admin.edit',['admin'=>$post->id])}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a  title="Delete" class="btn btn-xs btn-danger delete-row" 
                            href="{{ route('admin.destroy',['admin'=>$post->id])}}" 
                            onclick=" 
                            event.preventDefault(); 
                            document.getElementById('form-delete').submit(); 
                            return confirm('Do you really want  to delete ?');
                            ">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->author->name}}</td>
                        <td>{{$post->category->title}}</td>
                        <td><abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr> | {!!$post->publicationLabel()!!}</td>
                      </tr>
                    @endforeach
                    <form id="form-delete" action="{{ route('admin.destroy',['admin'=>$post->id]) }}" method="POST">
                      @csrf
                      @method("DELETE")
                    </form>
                    {{-- <span class="label label-success">Published</span>
                    <span class="label label-warning">Draft</span> --}}
                  </tbody>
                </table>
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

     
 @endsection