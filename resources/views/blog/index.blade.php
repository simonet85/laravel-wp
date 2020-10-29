@extends('layouts.master')
@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if( isset($categoryName))
                <div class="alert alert-info text-center">
                <p>Category : <strong>{{$categoryName}}</strong> </p>
                </div>
            @endif
            @if( isset($authorName))
            <div class="alert alert-info text-center">
            <p>Author : <strong>{{$authorName}}</strong> </p>
            </div>
            @endif
            @foreach($posts as $post)
            <article class="post-item">
                @if(!file_exists( public_path().'/assets/frontend/img'.$post->image ))
                
                <div class="post-item-image">
                    <a href="{{route('blog.show',['blog'=>$post->slug])}}">
                        <img src="{{asset('assets/frontend/img'.'/'.$post->image)}}" >
                    </a>
                </div>
                @endif
                <div class="post-item-body">
                    <div class="padding-10">
                        <h2><a href="{{route('blog.show',['blog'=>$post->slug])}}">{{$post->title}}</a></h2>
                        {!! Markdown::convertToHtml( e($post->excerpt) ) !!}
                    </div>

                    <div class="post-meta padding-10 clearfix">
                        <div class="pull-left">
                            <ul class="post-meta-group">
                                <li><i class="fa fa-user"></i><a href="{{route('author.show',['author'=>$post->author->slug])}}"> {{$post->author->name}}</a></li>
                                <li><i class="fa fa-clock-o"></i><time>  {{$post->date}}</time></li>
                            <li><i class="fa fa-folder"></i><a href="{{route('category.show',["category"=>$post->category->slug])}}"> {{$post->category->title}}</a></li>
                                <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                            </ul>
                        </div>
                        <div class="pull-right">
                            <a href="{{route('blog.show',['blog'=>$post->slug])}}">Continue Reading &raquo;</a>
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

 