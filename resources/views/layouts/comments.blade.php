<article class="post-comments" id="post-comments">
    <?php $commentNumber = $post->comments->count();?>
    <h3><i class="fa fa-comments"></i> 
        {{ $commentNumber }} {{ str_plural('Comment', $commentNumber)}} 
    </h3>

    <div class="comment-body padding-10" id="post-comments">
        <ul class="comments-list">
            @foreach ($postComments as $comment)
                
            <li class="comment-item">
                <div class="comment-heading clearfix">
                    <div class="comment-author-meta">
                        <h4>{{$comment->author_name}} <small>{{$comment->date}}</small></h4>
                    </div>
                </div>
                <div class="comment-content">
                    {!!$comment->body_html!!}
                </div>
            </li>

            @endforeach

        </ul>

        <nav class="text-center">
            {!! $postComments->links() !!}
        </nav>

    </div>

    <div class="comment-footer padding-10">
        <h3>Leave a comment</h3>
    <form method="POST" action="{{ route('comments') }}">
            @csrf
           
            <input type="hidden" name="post_id" value="{{$post->id}}">
           
            <div class="form-group @error('author_name') has-error @enderror">
                <label for="author_name">Name</label>
                <input type="text" name="author_name" id="name" class="form-control" value="{{old('author_name')}}">
                @error('author_name')
                <span class="help-block">
                    {{$errors->first('author_name')}}
                </span>
                @enderror
            </div>
            <div class="form-group @error('author_email') has-error @enderror required">
                <label for="author_email">Email</label>
                <input type="text" name="author_email" id="email" class="form-control"  value="{{old('author_email')}}">
                @error('author_email')
                <span class="help-block">
                    {{$errors->first('author_email')}}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" name="author_url" id="website" class="form-control"  value="{{old('author_url')}}">
            </div>
           
            <div class="form-group @error('body') has-error @enderror required">
                <label for="comment">Comment</label>
                <textarea name="body" id="comment" rows="6" class="form-control">{{old('body')}}</textarea>
                @error('body')
                <span class="help-block">
                    {{$errors->first('body')}}
                </span>
                @enderror
            </div>
         
            <div class="clearfix">
                <div class="pull-left">
                    <button type="submit" class="btn btn-lg btn-success">Submit</button>
                </div>
                <div class="pull-right">
                    <p class="text-muted">
                        <span class="required">*</span>
                        <em>Indicates required fields</em>
                    </p>
                </div>
            </div>
        </form>
    </div>

</article>