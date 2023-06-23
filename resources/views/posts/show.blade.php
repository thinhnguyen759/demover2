
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
                    <h1>post detail page</h1>
                    <h2>Title: {{ $post->title }}</h2>
                    <h2> Author: {{ $post->user->name }}</h2>
                    <p> Content: {!! $post->content!!} </p>

                    <br>
                    <p>
                        @foreach ($tags as $tag)
                            <span style="background: lightblue; margin: 2px; padding:2px"> {{ $tag->name }}</span>
                        @endforeach
                        <br>
                    </p>
                    @auth
                        @if (\Illuminate\Support\Facades\Auth::id() == $post->user_id)
                            <button><a href="/posts/{{ $post->id }}/edit">Edit</a></button>
                            <form action="/posts/{{ $post->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button>Delete</button>
                            </form>
                        @endif
                    @endauth
                    <br>
                    <h3> Comments</h3>
                    //show cmt
                        @foreach ($comments as $index => $comment)
                        <p id="comment-{{ $comment->id }}">#{{ $index + 1 }}: {{ $comment->user->name }} said:
                            {{ $comment->content }} </p>
                        @auth
                            @if (\Illuminate\Support\Facades\Auth::id() == $comment->user_id)
                                //from edit cmt
                                    <form id="edit-comment-{{ $comment->id }}" action="/comments/{{ $comment->id }}/"
                                      method="post"
                                      style="display: none">
                                    @csrf
                                    #{{ $index + 1 }}:<input type="text" name="content" value="{{ $comment->content }}">
                                    <button type="button" onclick="hideEditCommentForm({{ $comment->id }})">Cancel
                                    </button>
                                    <form action="/comments/{{ $comment->id }}/" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit">Update</button>
                                    </form>
                                </form>
                                <form action="/comments/{{ $comment->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button>delete</button>
                                </form>
                                <button onclick="displayEditCommentForm({{ $comment->id }})">Edit</button>
                            @endif
                        @endauth
                    @endforeach

                    <!-- add new comment -->
                    <form action="/comments" method="post">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="text" name="content">
                        <button type="submit"> Add comment</button>
                    </form>


                    <br>
                    <a href="/posts">Back to all post</a>
                    <script>
                        function displayEditCommentForm(id) {
                            let cmtFormEl = document.getElementById("edit-comment-" + id);
                            cmtFormEl.style.display = "block";
                            let cmtEl = document.getElementById("comment-" + id);
                            cmtEl.style.display = "none";
                        }
                        function hideEditCommentForm(id) {

                            let cmtFormEl = document.getElementById("edit-comment-" + id);
                            cmtFormEl.style.display = "none";
                            let cmtEl = document.getElementById("comment-" + id);
                            cmtEl.style.display = "block";
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>






