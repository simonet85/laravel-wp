<table class="table table-bordered table-condesed">
    <thead>
        <tr>
          <th>Action</th>
          <th>Category Name</th>
          <th class="text-center">Posts by Category Count</th>
        </tr>
    </thead>
    <tbody>
     {{-- {{dd($posts)}} --}}
      @foreach($categories as $category)
        <tr>
          <td >
            <form style="display:inline-block"
            action="{{ route('categories.edit',['category'=>$category->id]) }}" method="GET">
            @csrf
           
            <button name="edit" type="submit" title="Edit" class="btn btn-xs btn-default edit-row" >
              <i class="fa fa-edit"></i>
            </button> 
            </form>
         

            <form id="form-delete" style="display:inline-block"
              action="{{ route('categories.destroy',['category'=>$category->id]) }}" method="POST">
              @csrf
              @method("DELETE")

              <button name="delete" type="submit" title="Delete" class="btn btn-xs btn-danger delete-row" 
              onsubmit="return confirm('Do you really want to delete?');"
              >
                <i class="fa fa-times"></i>
              </button>
            
            </form>
          </td>
          <td>{{$category->title}}</td>
          <td class="text-center">  <p class="badge badge-info"> {{$category->posts->count()}}</p></td>
        </tr>
       
      @endforeach
     
      {{-- <span class="label label-success">Published</span>
      <span class="label label-warning">Draft</span> --}}
    </tbody>
  </table>