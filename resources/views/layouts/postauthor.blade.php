<article class="post-author padding-10">
    <div class="media">
      <div class="media-left">
        <a href="{{route('author.show',["author"=>$post->author->slug])}}">
          <img alt="{{$post->author->name}}" src="{{asset('assets/img'.'/'.$post->image)}}" class="media-object">
        </a>
      </div>
      <div class="media-body">
      <h4 class="media-heading"><a href="{{route('author.show',["author"=>$post->author->slug])}}">{{$post->author->name}}</a></h4>
        <div class="post-author-count">
           <?php $postsCount = $post->author->posts->count();?>
          <a href="{{route('author.show',["author"=>$post->author->slug])}}">
              <i class="fa fa-clone"></i>
              {{$postsCount}}  {{str_plural('Post', $postsCount)}}
          </a>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad aut sunt cum, mollitia excepturi neque sint magnam minus aliquam, voluptatem, labore quis praesentium eum quae dolorum temporibus consequuntur! Non.</p>
      </div>
    </div>
</article>
