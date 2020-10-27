<article class="post-author padding-10">
    <div class="media">
        <?php $author = $post->author ?>
      <div class="media-left">
        <a href="{{route('author.show',["author"=>$author->slug])}}">
          <img alt="{{$author->name}}" src="{{$author->gravatar()}}" class="media-object">
        </a>
      </div>
      <div class="media-body">
      <h4 class="media-heading"><a href="{{route('author.show',["author"=>$author->slug])}}">{{$author->name}}</a></h4>
        <div class="post-author-count">
           <?php $postsCount = $author->posts()->published()->count();?>
          <a href="{{route('author.show',["author"=>$author->slug])}}">
              <i class="fa fa-clone"></i>
              {{$postsCount}}  {{str_plural('Post', $postsCount)}}
          </a>
        </div>
       {!! Markdown::convertToHtml( e($author->bio) ) !!}
      </div>
    </div>
</article>
