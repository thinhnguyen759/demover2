<div class="card post-card">
    <div class="post-header">
        <div class="row">
            <div class="col-sm-2">
                <IMG src="{{$post->user->avatar}}" alt="" class="avatar" style="height: 50px; width: 50px">
            </div>
            <div class="col-sm-10">
                <h3>{{$post->user->name}}</h3>
                <p><span> {{ $post -> created_at -> diffforhumans() }} </span></p>
            </div>

        </div>

    </div>
    {{--    <img src="#" class="card-img-top" alt="...">--}}
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{!! Str::words( $post->content, 20) !!}</p>
        <div class="info">
            <div class="row">
                <div class="col"><i class="bi bi-hand-thumbs-up"><span
                            id="like-count-{{$post->id }}">{{ $post->reactions->count() }}</span></i></div>
                <div class="col">Comments: {{$post->comments->count()}}</div>

            </div>
        </div>

        <div class="card-footer">
            <div class="action-buttons">
                <div class="row">
                    <div class="col">
                        {{--                        <form action="/reactions" method="post">--}}
                        {{--                            @csrf--}}
                        {{--                        <input name="post_id" value="{{ $post->id }}" type="hidden">--}}
                        {{--                            <button class="btn {{ $post -> reaction == null? '':'reaction-liked' }}"><i class="bi bi-hand-thumbs-up"></i>like</button>--}}
                        {{--                        </form>--}}
                        <button id="like-bnt-{{ $post -> id }}" onclick="likePost({{$post->id}})"
                                class="btn {{ $post -> reaction == null? '':'reaction-liked' }}"><i
                                class="bi bi-hand-thumbs-up"></i>like
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn"><i class="bi bi-chat"></i> comment</button>

                    </div>
                    <div class="col">
                        <a href="/posts/{{$post->id}}">
                            <button class="btn"><i class="bi bi-share"></i> share</button>
                        </a>
                    </div>
                </div>
            </div>
            <div id="">
                <!-- add new comment -->

                <div class="row mt-4">
                    <div class="col-md-12">
                        <form action="#" method="post" class="add-comment" id="comment-form">
                            @csrf
                            <div class="d-flex mb-3">
                                <div class="avatar-md me-3">
                                    <img src="{{ Auth::user()->avatar }}" width="38" height="38" alt="{{ Auth::user()->name }}" class="rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <input type="hidden" id="post_id" value="{{ $post->id }}">
                                    <input id="comment-content" class="form-control comment-input" placeholder="Write a comment..." name="content" rows="1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="comment-buttons d-flex">
                                            <a href="#" class="comment-button text-primary me-2"><i class="bi bi-emoji-smile"></i></a>
                                            <a href="#" class="comment-button text-primary me-2"><i class="bi bi-image"></i></a>
                                        </div>
                                        <button id="add-comment" type="submit" class="btn btn-primary btn-sm">Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- hiển thị comments -->
{{--                @foreach ($post['comments'] as $index => $comment)--}}
{{--                    <p id="comment-{{ $comment->id }}">#{{ $index + 1 }}: {{ $comment->user->name }}--}}
{{--                        said: {{ $comment->content }} </p>--}}
{{--                @endforeach--}}
            </div>
        </div>
    </div>
</div>




