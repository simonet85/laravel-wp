<div class="col-md-4">
    <aside class="right-sidebar">

       @include('layouts.search-widget')

        <div class="widget">
            <div class="widget-heading">
                <h4>Categories</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach($categories as $category)
                    @if(($category->posts->count()) > 0)
                    <li>
                        <a href="{{route('category.show',["category"=>$category->slug])}}"><i class="fa fa-angle-right"></i> {{$category->title}}</a>
                        <span class="badge pull-right">{{$category->posts->count()}}</span>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Popular Posts</h4>
            </div>
            <div class="widget-body">
                <ul class="popular-posts">
                    @foreach($popularPosts as $post)
                    <li>
                        @if(!file_exists( public_path().'/assets/frontend/img'.$post->image ))
                        <div class="post-image">
                        <a href="{{route('blog.show',['blog'=>$post->slug])}}">
                                <img src="{{asset('assets/frontend/img'.'/'.$post->image)}}" />
                            </a>
                        </div>
                        @endif
                        <div class="post-body">
                            <h6><a href="{{route('blog.show',['blog'=>$post->slug])}}">{{$post->title}}</a></h6>
                            <div class="post-meta">
                                <span>{{$post->date}}</span>
                            </div>
                        </div>
                    </li>
                   @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Tags</h4>
            </div>
            <div class="widget-body">
                <ul class="tags">
                    @foreach($tags as $tag)
                    <li><a href="{{route('tag',["tag"=>$tag->slug])}}">{{$tag->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div> 

        <div class="widget">
            <div class="widget-heading">
                <h4>Archives</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach( $archives as $archive)
                        <li>
                            <a href="{{route('blog',['month'=>$archive->month, 'year'=>$archive->year])}}">
                            {{$archive->month.' '.$archive->year}}</a>
                        {{-- post_count: counts each post id's --}}
                            <span class="badge pull-right">{{$archive->post_count}}</span>
                        </li>
                   @endforeach
                </ul>
            </div>
        </div> 
    </aside>
</div>