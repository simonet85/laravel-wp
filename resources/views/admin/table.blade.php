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
      @foreach($posts as $post)
        <tr>
          <td width="70">
            <form 
            action="{{ route('admin.edit',['admin'=>$post->id]) }}" method="GET">
            @csrf
           
            <button name="edit" type="submit" title="Edit" class="btn btn-xs btn-default edit-row" >
              <i class="fa fa-edit"></i>
            </button> 
            </form>
          </td>
          <td colspan="2">

          <form id="form-delete" 
            action="{{ route('admin.destroy',['admin'=>$post->id]) }}" method="POST">
            @csrf
            @method("DELETE")

            <button name="delete" type="submit" title="Delete" class="btn btn-xs btn-danger delete-row" 
            onsubmit="return confirm('Do you really want to delete?');"
            >
              <i class="fa fa-times"></i>
            </button>
           
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