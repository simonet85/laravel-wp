@extends('layouts.master')
@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @foreach($posts as $post)
            <article class="post-item">
                @if(!file_exists( public_path().'/assets/img'.$post->image ))
                
                <div class="post-item-image">
                    <a href="{{route('blog.show',['blog'=>$post->id])}}">
                        <img src="{{asset('assets/img'.'/'.$post->image)}}" >
                    </a>
                </div>
                @endif
                <div class="post-item-body">
                    <div class="padding-10">
                        <h2><a href="{{route('blog.show',['blog'=>$post->id])}}">{{$post->title}}</a></h2>
                        <p>{{$post->excerpt}}</p>
                    </div>

                    <div class="post-meta padding-10 clearfix">
                        <div class="pull-left">
                            <ul class="post-meta-group">
                                <li><i class="fa fa-user"></i><a href="#"> {{$post->author->name}}</a></li>
                                <li><i class="fa fa-clock-o"></i><time>  {{$post->date}}</time></li>
                                <li><i class="fa fa-tags"></i><a href="#"> Blog</a></li>
                                <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                            </ul>
                        </div>
                        <div class="pull-right">
                            <a href="{{route('blog.show',['blog'=>$post->id])}}">Continue Reading &raquo;</a>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
         

            <nav>
              {{$posts->links()}}
            </nav>
        </div>
        {{-- Sidebar --}}
        @include('layouts.sidebar')
    </div>
</div>

@endsection

 