<table class="table table-bordered table-condesed">
    <thead>
        <tr>
          <th>Action</th>
          <th></th>
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
            <form 
            action="{{ route('admin.restore',['id'=>$post->id]) }}" method="POST">
            @csrf
            @method("PUT")
           
            @if( check_users_permissions( $request,'Backend@restore', $post->id) )
            <button   
                type="submit"                
                title="restore" class="btn btn-xs btn-default edit-row" >
              <i class="fa fa-refresh"></i>
            </button>
            @else
            <button   
                type="submit"                
                title="restore" class="btn btn-xs btn-default edit-row disabled" >
              <i class="fa fa-refresh"></i>
            </button>
            @endif
            </form>
            
          </td>
          <td>
          <form 
            action="{{ route('admin.force-destroy',['admin'=>$post->id]) }}" method="POST">
            @csrf
            @method("DELETE")

            @if( check_users_permissions( $request,'Backend@forcedestroy', $post->id) )
            <button name="delete" type="submit" title="Delete" class="btn btn-xs btn-danger delete-row" onclick="return confirm('Do you want to parmently delete the post?');">
              <i class="fa fa-trash-o"></i>
             
            </button>
            @else
            <button name="delete" type="submit" title="Delete" class="btn btn-xs btn-danger delete-row disabled" onclick="return confirm('Do you want to parmently delete the post?');">
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