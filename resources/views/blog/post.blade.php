@extends('layouts.master')
@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <article class="post-item post-detail">
                <div class="post-item-image">
                    <a href="#">
                        <img src="{{asset('assets/img'.'/'.$post->image)}}" alt="">
                    </a>
                </div>

                <div class="post-item-body">
                    <div class="padding-10">
                        <h1>{{$post->title}}</h1>

                        <div class="post-meta no-border">
                            <ul class="post-meta-group">
                                <li><i class="fa fa-user"></i><a href="#"> {{$post->author->name}}</a></li>
                                <li><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></li>
                                <li><i class="fa fa-tags"></i><a href="#"> Blog</a></li>
                                <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                            </ul>
                        </div>

                        {!! Markdown::convertToHtml( e($post->body) ) !!}
                       
                    </div>
                </div>
            </article>

            @include('layouts.comments')
        </div>
        @include('layouts.sidebar')
    </div>
</div>

@endsection
