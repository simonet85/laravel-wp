<div class="search-widget">
    <form action="{{route('blog.index')}}" method="get" style="display: inline-block;">
        <div class="input-group">
            
            <input type="text" class="form-control input-lg" name="search" value="{{request('search')}}" placeholder="Search for...">
            <span class="input-group-btn">
            <button class="btn btn-lg btn-default" type="submit">
                <i class="fa fa-search"></i>
            </button>
            </span>

        </div>
    </form>
</div> 