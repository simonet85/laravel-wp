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

        {{-- <div class="widget">
            <div class="widget-heading">
                <h4>Tags</h4>
            </div>
            <div class="widget-body">
                <ul class="tags">
                    <li><a href="#">PHP</a></li>
                    <li><a href="#">Codeigniter</a></li>
                    <li><a href="#">Yii</a></li>
                    <li><a href="#">Laravel</a></li>
                    <li><a href="#">Ruby on Rails</a></li>
                    <li><a href="#">jQuery</a></li>
                    <li><a href="#">Vue Js</a></li>
                    <li><a href="#">React Js</a></li>
                </ul>
            </div>
        </div> --}}
    </aside>
</div>