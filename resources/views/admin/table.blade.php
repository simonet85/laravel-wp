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
     {{-- {{dd($posts)}} --}}
     <?php $request = request();?>
      @foreach($posts as $post)
      
        <tr>

          <td width="70">
            <form style="display: inline-block;"
            action="{{ route('admin.edit',['admin'=>$post->id]) }}" method="GET">
            @csrf
           
            @if( check_users_permissions( request(),'Backend@edit', $post->id) )
            <button name="edit" type="submit" title="Edit" class="btn btn-xs btn-default edit-row" >
              <i class="fa fa-edit"></i>
            </button> 
            @else
            <button name="edit" type="submit" title="Edit" class="btn btn-xs btn-default edit-row disabled" >
              <i class="fa fa-edit"></i>
            </button> 
            @endif
            </form>
         

          <form id="form-delete" style="display: inline-block;"
            action="{{ route('admin.destroy',['admin'=>$post->id]) }}" method="POST">
            @csrf
            @method("DELETE")

            @if( check_users_permissions( request(),'Backend@destroy', $post->id) )
            <button name="delete" type="submit" title="Delete" class="btn btn-xs btn-danger delete-row" 
            onsubmit="return confirm('Do you really want to delete?');"
            >
              <i class="fa fa-trash-o"></i>
            </button>
            @else
            <button name="delete" type="submit" title="Delete" class="btn btn-xs btn-danger delete-row disabled" 
            onsubmit="return confirm('Do you really want to delete?');"
            >
              <i class="fa fa-trash-o"></i>
            </button>
           @endif
          </form>
          </td>
          <td>{{$post->title}}</td>
          <td>{{$post->author->name}}</td>
          <td>{{$post->category->title}}</td>
          <td><abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr> | {!!$post->publicationLabel()!!}</td>
        </tr>
       
      @endforeach
     
      {{-- <span class="label label-success">Published</span>
      <span class="label label-warning">Draft</span> --}}
    </tbody>
  </table>